<div style="text-align: center;">
    <h3></h3>
    <h3></h3>
    <h3><b>LAPORAN HAFALAN SANTRI PER JUZ</b></h3>
</div>
<br>
<div class="row">
    <div class="col">
        Bulan : <?= $b ?>
    </div>
    <div class="col">
        Tahun : <?= $y ?>
    </div>
</div>
<table border="1">
    <tr style="text-align: center;">
        <th>Juz</th>
        <th>Jumlah Santri</th>
    </tr>
    <?php for ($i = 0; $i < 30; $i++) { ?>
        <tr style="text-align: center;">
            <td><?= $i + 1 ?></td>
            <td><?= $santri[$i] ?> santri</td>
        </tr>
    <?php } ?>
</table>