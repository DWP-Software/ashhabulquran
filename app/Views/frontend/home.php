<?= $this->extend('frontend/template'); ?>
<?= $this->section('content'); ?>
<section id="Tentang" class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Tentang Kami</h2>
            <span>Apa</span>
        </div>
        <div class="row">
            <p>Bismillahirrahmanirrahim</p>
            <p>Mari bersama membangun sekolah yang berbasis ketaqwaan, agar keberkahan dunia pendidikan Islam dapat hadir kembali ditengah-tengah masyarakat .
                Kepedulian Anda untuk merealisasikan Sekolah berbasic Infaq adalah Solusi terbaik untuk melahirkan kembali Sekolah yang berbasis Ketaqwaan.
                Disinilah ACT hadir untuk menjembatani hal ini.
                Karena ketika kita investasikan harta kita untuk Amal Jariyah Membangun SD Qur'an Uswatun Hasanah, Rumah Tahfizh Shohibul Qur'an dan Taud Bunayya , maka secara otomatis, Satu Huruf Al Quran yang dibaca oleh para Siswa merupakan Rekening Pahala Bagi Sahabat Dermawan
            </p>
        </div>

        <div class="container">
            <div class="shot-item">
                <img src="img/bg/logo1.jpg" alt="" />
                <div class="table-cell">
                    <div class="">
                        <a class="" href="img/bg/logo1.JPG"></a>
                    </div>
                </div>
            </div>
        </div>

</section>
<section>
    <div class="container">
        <div class="row">
            <div>
                <div class="col-lg-6 col-md-6 col-xs-13">
                    <h2>Visi</h2>
                    <p>Menjadi lembaga tahfizh yang berkualitas dengan mencontoh generasi
                        salafus shalih yang mampu mencetak kader penghafal al-qur'an yang mutqin
                        bermanhaj ahlus sunnah wal-jama'ah dan memiliki akhlaq dan adab yang mulia
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-13" style="float:right;">
                    <h2>Misi</h2>
                    <p>1. Menyelenggarakan sistem layanan hafalan al-qur'an yang komprehensif dan terpadu serta mampu menyiapkan lulusannya untuk menjadi generasi muslim sesuai manhaj salafush shalih
                    </p>
                    <p>2. Mengajarkan ilmu al-qur'an sejak dini(balita) kepada anak-anak kaum muslimin</p>
                    <p>3. Menciptakan generasi pemuda dan pemudi islam yang mencintai al-qur'an sebagai bagian dari hidupnya yang tak terpisahkan </p>
                    <p>4. Menjadikan al-qur'an segalanya dalam kehidupan sehari-hari (qur'an dulu,qur'an lagi,qur'an selalu</p>
                    <p>5. Mencetak pengajar al-qur'an yang kompeten</p>
                    <p>6. Mencetak kader-kader imam shalat dan pemimpin qurani</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="Galeri" class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Galeri</h2>
            <span>Galeri</span>
            <p class="section-subtitle">Kegiatan-kegiatan yang ada di Rumah Tahfidz Shohibul Qur'an.</p>


        </div>
        <div class="row">
            <?php foreach ($galeri as $data) { ?>
                <div class="col">
                    <div><img style="max-width: 60%;" src="<?= base_url() ?>/galeriimg/<?= $data['foto'] ?>" alt=""></div>
                    <div><?= $data['nama_kegiatan'] ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<div id="Pendaftaran" class="section pricing-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Pendaftaran</h2>
            <span>Pendaftaran</span>
        </div>

        <div class="row pricing-tables">
            <div class="col-lg-6 col-md-6 col-xs-13">
                <div class=" pricing-table">
                    <div class="pricing-details">
                        <h2>Formulir Surat Pernyataan Orang Tua</h2>
                    </div>
                    <div class="plan-button">
                        <a target="_blank" href="<?= base_url('/pendaftaran/SuratPernyataanOrangTua.pdf') ?>" class="btn btn-common bt-effect">Download</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-13">
                <div class="pricing-table">
                    <div class="pricing-details">
                        <h2>Formulir Pendaftaran</h2>
                    </div>
                    <div class="plan-button">
                        <a target="_blank" href="<?= base_url('/pendaftaran/PendaftaranSantri.pdf') ?>" class="btn btn-common bt-effect">Download</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<section id="contact" class="section">
    <div class="contact-form">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Hubungi Kami</h2>
                <span>Kontak</span>
            </div>
            <div class="row">
                <div class="contact-deatils">
                    <div class="contact-info_area">
                        <div class="contact-info">
                            <i class="lni-map"></i>
                            <h5>Alamat</h5>
                            <p>Rumah Tahfizh Shohibul Quran Depan Masjid Taqwa Koto Tinggi Nagari Pandai Sikek
                                Kec. X Koto Kab. Tanah Datar Sumatera Barat</p>
                        </div>
                        <div class="contact-info">
                            <i class="lni-star"></i>
                            <h5>E-mail</h5>
                            <p>info@example.com</p>
                        </div>
                        <div class="contact-info">
                            <i class="lni-phone"></i>
                            <h5>Phone</h5>
                            <p><?= $telp->telp1 ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="google-map-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 padding-0">
                <div style="width= 2500px; "><?= $map->maps ?></div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>