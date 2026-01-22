$(document).ready(function () {
    $('.select2-father').select2({
        placeholder: 'Cha',
        allowClear: true,
    });

    $('.select2-mother').select2({
        placeholder: 'Mẹ',
        allowClear: true,
    });

    $('.select2-spouse').select2({
        placeholder: 'Vợ / Chồng',
        allowClear: true,
    });

    $('.select2-father').on('change', function () {
        let fatherId = $(this).val();

        let $mother = $('.select2-mother');
        let $spouse = $('.select2-spouse');

        if (!fatherId) {
            $mother.empty().trigger('change');
            $spouse.empty().trigger('change');
            return;
        }

        // ===== LOAD MOTHER =====
        $.ajax({
            url: '/members/get-mother-by-father/' + fatherId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $mother.empty().append('<option></option>');

                data.forEach(function (item) {
                    $mother.append(
                        new Option(item.full_name, item.id, false, false)
                    );
                });

                $mother.trigger('change.select2');
            }
        });
    });
});