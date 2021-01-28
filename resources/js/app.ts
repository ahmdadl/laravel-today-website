// require('alpinejs');

import '@ryangjchandler/spruce';

import 'alpinejs';

import Axios from 'axios';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Axios.interceptors.response.use(
    function (response) {
        // TODO show loader
        console.log(response.data);
        return response;
    },
    function (error) {
        // TODO hide loader
        if (error.response.status === 422) {
            return error.response;
        }
        // console.log(error.response);
        console.log(error);
        $notify.error('an error was occured, please');
        return Promise.reject(error);
    }
);

class Notify {
    public fire(name: string = 'info', message: string): void {
        // TODO add CustomEvent pollyfill
        var event = new CustomEvent(name, {
            detail: {
                message,
            },
        });

        window.dispatchEvent(event);
    }

    public success(message: string): void {
        this.fire('notify-success', message);
    }

    public error(message: string): void {
        this.fire('notify-error', message);
    }

    public warn(message: string): void {
        this.fire('notify-warn', message);
    }

    public info(message: string): void {
        this.fire('notify-info', message);
    }
}

const $notify = new Notify();

// @ts-ignore
window.Spruce.store('axios', {
    ...Axios,
});

// @ts-ignore
window.Spruce.store('post', {
    like: async (slug: string, icon: string, isLike: boolean = true): Promise<boolean | null> => {
        const btnId = isLike ? 'like' : 'dislike'
        const loader = document.querySelector(
            `#${slug} #${btnId} #loader`
        ) as HTMLElement;
        const btn = document.querySelector(`#${slug} #${btnId}`) as HTMLElement;
        loader.classList.add('fa-spin', 'fa-cog');
        loader.classList.remove(icon);
        btn.setAttribute('disabled', 'disabled');

        let data = isLike ? { like: true } : {};

        const res = await Axios.post(`/${slug}/like`, data);
        
        loader.classList.remove('fa-spin', 'fa-cog');
        loader.classList.add(icon);
        btn.removeAttribute('disabled');

        if (res.status !== 201) {
            $notify.error('an error was occured, please');
            return null;
        }

        $notify.success('Done')

        return true;
    },
});

// @ts-ignore
window.Spruce.store('toast', {
    arr: [],
    add(message: string, type: string = 'default') {
        this.arr.push({ show: true, message, type });
        setTimeout((_) => {
            this.remove(message);
        }, 3000);
        // console.log(message, type);
    },
    info(message: string) {
        this.add(message);
    },
    warn(message: string) {
        this.add(message, 'warn');
    },
    error(message: string) {
        this.add(message, 'danger');
    },
    success(message: string) {
        this.add(message, 'success');
    },
    remove(message: string) {
        const inx = this.arr.findIndex((x) => x.message === message);
        if (!this.arr[inx]) return;
        this.arr[inx].show = false;
        this.arr.splice(inx, 1);
    },
});

// @ts-ignore
window.Spruce.store('common', {
    dark:
        JSON.parse(localStorage.getItem('dark-theme') as string) ||
        (!!window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleDark(): void {
        this.dark = !this.dark;
        localStorage.setItem('dark-theme', this.dark);
    },
    testMail(mail: string) {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
            mail
        );
    },
    formatNum: (num: number) => {
        var si = [
          { value: 1, symbol: "" },
          { value: 1E3, symbol: "k" },
          { value: 1E6, symbol: "M" },
          { value: 1E9, symbol: "G" },
          { value: 1E12, symbol: "T" },
          { value: 1E15, symbol: "P" },
          { value: 1E18, symbol: "E" }
        ];
        var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
        var i;
        for (i = si.length - 1; i > 0; i--) {
          if (num >= si[i].value) {
            break;
          }
        }
        return (num / si[i].value).toFixed(1).replace(rx, "$1") + si[i].symbol;
      }
});