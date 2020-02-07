const Obj = {

    addTender: function (form) {
        let data = {
            action: 'insertData',
            data: {}
        };
        $(form.elements).each(function (i, element) {
            if ((element.tagName == 'INPUT' || element.tagName == 'TEXTAREA')) {
                data.data[element.name] = element.value;
            }
        });
        let callback = function (response) {
            // console.log(response);
            if (response.result === 'true') {
                $('table.table tbody').html(response.html);
                $(form).find('button[type="submit"]').text('Добавлено').addClass('btn-success');
                $('.update-tender').on('click', function () {
                    Obj.showUpdateTr(this);
                });
                setTimeout(function () {
                    $(form).find('button[type="submit"]').text('Добавить тендер').removeClass('btn-success');
                }, 2000);
                form.reset();
            } else {
                $(form).find('button[type="submit"]').text('Не добавлено').addClass('btn-danger');
            }
        };
        ajax('index.php', 'JSON', data, callback);
    },

    showUpdateTr: function (button) {
        let tr = $(button).closest('tr');
        let id = $(tr).attr('id');
        let data = {
            action: 'showUpdateTr',
            data: {
                id: id
            }
        };
        let $this = this;
        let number = $(tr).find('td:first-child').text();
        let callback = function (response) {
            //console.log(response);
            if (response.result === 'true') {
                tr.html(response.html);
                $(tr).find('td:first-child').text(number);

                $('.update-tender-submit').on('click', function () {
                    $this.updateTender(this);
                });
                $('.delete-tender-submit').on('click', function () {
                    $this.deleteTender(this);
                });

            }
        };
        ajax('index.php', 'JSON', data, callback);
    },

    updateTender: function (button) {
        let tr = $(button).closest('tr');
        let id = $(tr).attr('id');
        let data = {
            action: 'updateTender',
            data: {
                id: id,
                update: {}
            }
        };
        tr.find('td').each(function (i, el) {
            if ($(el).find('input').length > 0) {
                data.data.update[$(el).find('input').attr('name')] = $(el).find('input').val();
            } else if ($(el).find('textarea').length > 0) {
                data.data.update[$(el).find('textarea').attr('name')] = $(el).find('textarea').val();
            }
        });
        let number = $(tr).find('td:first-child').text();
        let callback = function (response) {
            //console.log(response);
            if (response.result === 'true') {
                let html = response.html.slice(response.html.indexOf('<td>'), response.html.indexOf('</tr>'));
                tr.html(html);
                $(tr).find('td:first-child').text(number);

                $('.update-tender').on('click', function () {
                    Obj.showUpdateTr(this);
                });
            }
        };
        ajax('index.php', 'JSON', data, callback);
    },

    deleteTender: function (button) {
        let tr = $(button).closest('tr');
        let id = $(tr).attr('id');
        let data = {
            action: 'deleteTender',
            data: {
                id: id
            }
        };
        let callback = function (response) {
            //console.log(response);
            if (response.result === 'true') {
                $('table.table tbody').html(response.html);
                $('.update-tender').on('click', function () {
                    Obj.showUpdateTr(this);
                });
            }
        };
        ajax('index.php', 'JSON', data, callback);
    }

};


$(document).ready(function () {

    $('.add-tender').on('click', function () {
        $(this).hide();
        let form = $('.add-tender-form');
        form.removeClass('hidden');
        form.find('button[type="submit"]').text('Добавить тендер').removeClass('btn-success').removeClass('btn-danger');
    });

    $('.cancel').on('click', function () {
        $('.add-tender-form').addClass('hidden');
        $('.add-tender').show();
    });

    $('.add-tender-form').on('submit', function () {
        Obj.addTender(this);
        return false;
    });

    $('.update-tender').on('click', function () {
        Obj.showUpdateTr(this);
    });

});
