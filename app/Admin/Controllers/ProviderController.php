<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use ReflectionClass;

class ProviderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Provider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Provider());

        $grid->column('id', __('Id'));
        $grid->column('owner.name', __('User Nmae'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('url', __('Url'));
        $grid->column('request_url', __('Request url'));
        $grid->column('bio', __('Bio'));
        $grid->column('status', __('Status'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->loadMissing('owner');
        $show = new Show($provider);

        $show->field('id', __('Id'));
        $show->field('owner.name', __('User Name'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('url', __('Url'));
        $show->field('request_url', __('Request url'));
        $show->field('bio', __('Bio'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Provider());

        $form
            ->select('user_id', __('User id'))
            ->options(User::all()->pluck('name', 'id'));
        $form->text('title', __('Title'));
        // $form->text('slug', __('Slug'));
        $form->url('url', __('Url'));
        $form->text('request_url', __('Request url'));
        $form->text('bio', __('Bio'));
        $form->select('status', __('Status'))->options($this->getStatus());

        return $form;
    }

    private function getStatus(): array
    {
        return collect((new ReflectionClass(Provider::class))->getConstants())
            ->filter(fn($x) => is_int($x))
            ->flip()
            ->toArray();
    }
}
