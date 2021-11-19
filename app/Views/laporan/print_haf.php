<div style="text-align: center;">
    <h3></h3>
    <h3></h3>
    <h3><b>LAPORAN HAFALAN SANTRI TIAP PERTEMUAN</b></h3>
</div>
<br>
<div class="row">
    <div class="col">
        Kelas : <?= $k ?>
    </div>
    <div class="col">
        Bulan : <?= $b ?>
    </div>
    <div class="col">
        Tahun : <?= $y ?>
    </div>
</div>
<table border="1" style="padding:10;">
    <tr style="text-align: center;">
        <th>No.</th>
        <th>Nama Santri</th>
        <?php $no = 1;
        if ($tgl != NULL) {
            foreach ($tgl as $s) { ?>
                <th>Tanggal <?= $s ?></th>
        <?php }
            $no++;
        } ?>
    </tr>
    <?php $no = 1;
    foreach ($san as $s) { ?>
        <tr>
            <td style="text-align: center;"><?= $no ?></td>
            <td><?= $s['nama'] ?></td>
            <?php if ($data_san[$no - 1] != NULL) {
                foreach ($data_san[$no - 1] as $s) { ?>
                    <td><?= $s['nama_surah'] ?> : <?= $s['awal_hafalan'] ?> - <?= $s['akhir_hafalan'] ?></td>
                <?php }
            } else {
                for ($i = 0; $i < count($tgl); $i++) {
                ?>
                    <td><?= '-'; ?></td>
            <?php }
            } ?>
        </tr>
    <?php $no++;
    } ?>
</table>