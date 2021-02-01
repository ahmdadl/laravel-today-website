$(document).ready(function() {
    $('.approve').click(function() {
        const self = $(this);
        self.addClass('btn-warning')
        const id = self.attr('data-id');
        const state = self.attr('data-state');
        $.ajax({
            url: '/providers/' + id,
            type: 'PUT',
            data: {state},
        }).done(res => {
            if (!res || !res.updated) {
                alert('error');
                return;
            }
            self.addClass('btn-success')
            setTimeout(() => self.removeClass('btn-success'), 1000)
        }).fail(_ => alert('error'))
        .always(() => self.removeClass('btn-warning'));
    });
});