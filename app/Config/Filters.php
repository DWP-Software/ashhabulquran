<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'admin' => \App\Filters\AdminFilter::class,
		'pengajar' => \App\Filters\PengajarFilter::class,
		'santri' => \App\Filters\SantriFilter::class,
		'pemilik' => \App\Filters\PemilikFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
			'admin' => ['except' =>
			[
				'auth', 'auth/*',  // Login 
				'frontend', 'frontend/*'  // frontend 
			]],
			'pengajar' => ['except' =>
			[
				'auth', 'auth/*',  // Login 
				'frontend', 'frontend/*'  // frontend 
			]],
			'santri' => ['except' =>
			[
				'auth', 'auth/*',  // Login 
				'frontend', 'frontend/*'  // frontend 
			]],
			'pemilik' => ['except' =>
			[
				'auth', 'auth/*',  // Login 
				'frontend', 'frontend/*'  // frontend 
			]]
		],
		'after'  => [
			// 'toolbar',
			// 'honeypot',
			'admin' => ['except' =>
			[
				'frontend', 'frontend/*', '/',   // frontend 
				'home', 'home/*',    // Beranda 
				'pengajar', 'pengajar/*',   // Pengajar
				'santri', 'santri/*', // Santri
				'kelas', 'kelas/*',    // Kelas
				'hafalan', 'hafalan/*',    // hafalan
				'absensi', 'absensi/*',    // absensi
				'user', 'user/*',    // user
				'galeri', 'galeri/*',    // galeri
				'rumahtahfidz', 'rumahtahfidz/*',    // rumahtahfidz
				'laporan', 'laporan/*',    // rumahtahfidz
				'absen', 'absen/*',
				'absens', 'absens*',
				'gaji', 'gaji*',
			]],
			'pengajar' => ['except' =>
			[
				'frontend', 'frontend/*', '/',   // frontend 
				'home', 'home/*',    // Beranda 
				'kelas', 'kelas/*',    // Kelas
				'hafalan', 'hafalan/*',    // hafalan
				'absensi', 'absensi/*',    // absensi
				'profil', 'profil/*',    // profil
				'absen', 'absen/*',
				'absens', 'absens*',
			]],
			'santri' => ['except' =>
			[
				'frontend', 'frontend/*', '/',   // frontend 
				'home', 'home/*',    // Beranda 
				'hafalan', 'hafalan/*',    // hafalan
				'absensi', 'absensi/index',    // absensi
				'profil', 'profil/*',    // profil
			]],
			'pemilik' => ['except' =>
			[
				'home', 'home/*',    // Beranda 
				'laporan', 'laporan/*',    // hafalan
			]],
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
