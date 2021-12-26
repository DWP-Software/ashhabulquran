<div style="text-align: center;">
    <h3><b>DAFTAR SANTRI</b></h3>
    <h3><b>RUMAH TAHFIZH SHOHIBUL QURAN</b></h3>
    <h3><b>Koto tinggi pandaisikek kec. X koto Kabupaten Tanah Datar Sumbar</b></h3>
    <h3><b>TAHUN AJARAN <?= $y ?> BULAN <?= $b ?></b></h3>
</div>
<div class="col">
    <p>Pembimbing : <?= $pengajar ?></p>
    <p>Kelas : <?= $k ?></p>
</div>
<table border="1" style="padding:5;">
    <tr style="text-align: center;">
        <th style="width: 40px;">No.</th>
        <th style="width: 150px;">Nama Santri</th>
        <th style="width: 80px;">Usia</th>
        <th style="width: 80px;">JK</th>
        <th style="width: 150px;">Alamat</th>
        <th style="width: 100px;">No. HP</th>
        <th style="width: 105px;">No. HP Orang Tua</th>
        <th>Jumlah Hafalan</th>
    </tr>
    <?php $no = 1;
    foreach ($santri as $s) { ?>
        <tr>
            <td style="text-align: center;"><?= $no ?></td>
            <td><?= $s['nama'] ?></td>
            <td><?php if ($s['tgl_lahir'] != NULL) {
                    echo (date('Y') - date('Y', strtotime($s['tgl_lahir']))) . ' tahun';
                } ?></td>
            <td><?= $s['jk'] ?></td>
            <td><?= $s['alamat'] ?></td>
            <td><?= $s['nohp'] ?></td>
            <td><?= $s['nohp_ortu'] ?></td>
            <td><?php if ($s['jml_hafalan'] != NULL) {
                    echo $s['jml_hafalan'] . ' juz';
                } ?></td>
        </tr>
    <?php $no++;
    } ?>
</table>