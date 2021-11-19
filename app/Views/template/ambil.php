<script>
    function surah() {
        let id = $('#id_surah').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('hafalan/surah') ?>/" + id,
                method: "POST",
                dataType: "JSON",
                success: function(response) {
                    $('#awal').val(response.awal);
                }
            });
        }
    }

    function kelas() {
        let id = $('#id_kelas').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('hafalan/getsantri') ?>/" + id,
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih Nama Santri </option>';
                    for (i = 0; i < response.length; i++) {
                        html += '<option value="' + response[i].id_santri + '">' + response[i].nama + '</option>';
                    }
                    $('#id_santri').html(html);
                }
            });
        }
    }

    function santri() {
        let id = $('#id_santri').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('hafalan/san') ?>/" + id,
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih Nama Surah </option>';
                    for (i = 0; i < response.length; i++) {
                        html += '<option value="' + response[i].id_surah + '">' + response[i].nama_surah + ' - Juz ' + response[i].juz + '</option>';
                    }
                    $('#id_surah').html(html);
                }
            });
        }
    }
</script>