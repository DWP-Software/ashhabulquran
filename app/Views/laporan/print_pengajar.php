<div style="text-align: center;">
    <h3><b>DAFTAR PENGAJAR</b></h3>
    <h3><b>RUMAH TAHFIZH SHOHIBUL QURAN</b></h3>
    <h3><b>Koto tinggi pandaisikek kec. X koto Kabupaten Tanah Datar Sumbar</b></h3>
    <h3><b>TAHUN AJARAN <?= $t ?></b></h3>
</div>
<table border="1" style="padding:5;">
    <tr style="text-align: center;">
        <th style="width: 40px;">No.</th>
        <th style="width: 150px;">Nama</th>
        <th style="width: 70px;">JK</th>
        <th style="width: 80px;">Tahun Masuk</th>
        <th style="width: 210px;">Alamat</th>
        <th style="width: 90px;">No. HP</th>
        <th style="width: 88px;">Jumlah Hafalan</th>
    </tr>
    <?php $no = 1;
    foreach ($pengajar as $p) { ?>
        <tr>
            <td style="text-align: center;"><?= $no ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['jk'] ?></td>
            <td><?= $p['thn_masuk'] ?></td>
            <td><?= $p['alamat'] ?></td>
            <td><?= $p['nohp'] ?></td>
            <td><?php if ($p['jml_hafalan'] != NULL) {
                    echo $p['jml_hafalan'] . ' juz';
                } ?></td>
        </tr>
    <?php $no++;
    } ?>
</table>