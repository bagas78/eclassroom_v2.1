-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 11:18 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclassroom_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_album`
--

CREATE TABLE `t_album` (
  `album_id` int(11) NOT NULL,
  `album_name` text DEFAULT NULL,
  `album_kelas` text DEFAULT NULL,
  `album_pelajaran` text DEFAULT NULL,
  `album_tanggal` date DEFAULT NULL,
  `album_jenis` set('galery','video') DEFAULT NULL,
  `album_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_album`
--

INSERT INTO `t_album` (`album_id`, `album_name`, `album_kelas`, `album_pelajaran`, `album_tanggal`, `album_jenis`, `album_hapus`) VALUES
(3, 'Youtube Video', '1,2,3', '1', '2021-12-05', 'video', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_assigment`
--

CREATE TABLE `t_assigment` (
  `assigment_id` int(11) NOT NULL,
  `assigment_guru` text NOT NULL,
  `assigment_jenis` enum('individu','kelompok') NOT NULL,
  `assigment_judul` text NOT NULL,
  `assigment_isi` text NOT NULL,
  `assigment_pelajaran` text NOT NULL,
  `assigment_kelas` text NOT NULL,
  `assigment_tampil` date DEFAULT NULL,
  `assigment_unggah` date DEFAULT NULL,
  `assigment_jam` time DEFAULT NULL,
  `assigment_file` text DEFAULT NULL,
  `assigment_tanggal` date NOT NULL DEFAULT curdate(),
  `assigment_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_assigment`
--

INSERT INTO `t_assigment` (`assigment_id`, `assigment_guru`, `assigment_jenis`, `assigment_judul`, `assigment_isi`, `assigment_pelajaran`, `assigment_kelas`, `assigment_tampil`, `assigment_unggah`, `assigment_jam`, `assigment_file`, `assigment_tanggal`, `assigment_hapus`) VALUES
(2, '5', 'kelompok', 'carilah makalah tentang binary option judi berkedok trading binomo, aoutex', '<p>Catatan :</p>\r\n\r\n<p>1. Harus ada foto indrakenz</p>\r\n\r\n<p>2. harus ada foto doni salmanan</p>\r\n\r\n<p>3. harus ada &quot;murah banget&quot;</p>\r\n\r\n<p>4. harus ada foto jam rolex<br />\r\n&nbsp;</p>\r\n', '1', '1,2,3', '2022-03-19', '2022-03-18', '14:17:34', 'f26e42b4dbc1940dbec9666191cfc6ec.docx', '2022-02-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_assigment_hasil`
--

CREATE TABLE `t_assigment_hasil` (
  `assigment_hasil_id` int(11) NOT NULL,
  `assigment_hasil_soal` text NOT NULL,
  `assigment_hasil_siswa` text NOT NULL,
  `assigment_hasil_kelompok` text NOT NULL,
  `assigment_hasil_jenis` enum('individu','kelompok') NOT NULL,
  `assigment_hasil_file` text NOT NULL,
  `assigment_hasil_file_type` text NOT NULL,
  `assigment_hasil_catatan` text NOT NULL,
  `assigment_hasil_nilai` text NOT NULL,
  `assigment_hasil_nilai_catatan` text NOT NULL,
  `assigment_hasil_hapus` int(11) NOT NULL DEFAULT 0,
  `assigment_hasil_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_assigment_hasil`
--

INSERT INTO `t_assigment_hasil` (`assigment_hasil_id`, `assigment_hasil_soal`, `assigment_hasil_siswa`, `assigment_hasil_kelompok`, `assigment_hasil_jenis`, `assigment_hasil_file`, `assigment_hasil_file_type`, `assigment_hasil_catatan`, `assigment_hasil_nilai`, `assigment_hasil_nilai_catatan`, `assigment_hasil_hapus`, `assigment_hasil_tanggal`) VALUES
(13, '2', '11', '1', 'kelompok', 'd0b26fe5eb4d0f373c4cae27e3818172.docx', 'application', 'ini contoh', '', '', 0, '2022-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `t_chat`
--

CREATE TABLE `t_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_name` text DEFAULT NULL,
  `chat_user` text DEFAULT NULL,
  `chat_target` text DEFAULT NULL,
  `chat_text` text DEFAULT NULL,
  `chat_type` set('personal','group') DEFAULT NULL,
  `chat_view` text DEFAULT NULL,
  `chat_tanggal` date DEFAULT curdate(),
  `chat_waktu` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_chat`
--

INSERT INTO `t_chat` (`chat_id`, `chat_name`, `chat_user`, `chat_target`, `chat_text`, `chat_type`, `chat_view`, `chat_tanggal`, `chat_waktu`) VALUES
(195, '23', '12', '11,12', 'test', 'personal', '11,12', '2021-12-19', '13:15:15'),
(196, '23', '11', '11,12', 'test', 'personal', '11,12', '2021-12-19', '13:15:15'),
(198, '23', '11', '11,12', 'hallo uzumaki ?', 'personal', '11,12', '2021-12-19', '13:49:33'),
(199, '22', '11', '11,12', 'new', 'personal', '11,12', '2021-12-19', '13:49:33'),
(200, '22', '11', '11,12', 'new123', 'personal', '11,12', '2021-12-19', '13:49:33'),
(201, '16', '5', '5,11', 'hallo uciha ?', 'personal', '11,5', '2021-12-20', '09:20:57'),
(202, '16', '5', '5,11', 'Apa kabar uciha ?', 'personal', '11,5', '2021-12-20', '09:21:29'),
(203, '17', '5', '5,12', 'halo uzumaki ?', 'personal', '12,5', '2021-12-20', '09:28:35'),
(205, 'Group Receh', '5', '8,9,11,12', 'ini group baru gess', 'group', '12,5,8,11', '2021-12-20', '09:36:17'),
(207, 'Group Receh', '5', '8,9,11,12', 'test bro', 'group', '12,5,8,11', '2021-12-20', '10:58:59'),
(209, 'Group Receh', '12', '8,9,11,12', 'ok pak', 'group', '12,5,8,11', '2021-12-20', '11:13:52'),
(214, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:25:58'),
(215, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:27:21'),
(216, NULL, '11', NULL, 'test', '', '11', '2022-02-17', '11:28:39'),
(217, 'Group Receh', '8', '8,9,11,12', 'siap', 'group', '8,11', '2022-02-25', '23:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_collassion`
--

CREATE TABLE `t_collassion` (
  `collassion_id` int(11) NOT NULL,
  `collassion_pelajaran` text NOT NULL,
  `collassion_user` text NOT NULL,
  `collassion_kelas` text NOT NULL,
  `collassion_isi` text NOT NULL,
  `collassion_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_collassion`
--

INSERT INTO `t_collassion` (`collassion_id`, `collassion_pelajaran`, `collassion_user`, `collassion_kelas`, `collassion_isi`, `collassion_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>Tentang Collassion Learning</p>\r\n', '2022-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_diskusi`
--

CREATE TABLE `t_diskusi` (
  `diskusi_id` int(11) NOT NULL,
  `diskusi_type` set('kelas','materi','kelompok') NOT NULL,
  `diskusi_siswa` text NOT NULL,
  `diskusi_text` text NOT NULL,
  `diskusi_file` text NOT NULL,
  `diskusi_file_type` text NOT NULL,
  `diskusi_view` text NOT NULL,
  `diskusi_where` text NOT NULL,
  `diskusi_kelas` text NOT NULL,
  `diskusi_tanggal` date NOT NULL DEFAULT curdate(),
  `diskusi_waktu` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_diskusi`
--

INSERT INTO `t_diskusi` (`diskusi_id`, `diskusi_type`, `diskusi_siswa`, `diskusi_text`, `diskusi_file`, `diskusi_file_type`, `diskusi_view`, `diskusi_where`, `diskusi_kelas`, `diskusi_tanggal`, `diskusi_waktu`) VALUES
(7, 'kelas', '11', 'ok sip', '', '', '11,12,8', '1', '1', '2022-02-15', '12:03:05'),
(32, 'kelas', '12', 'ini file png', '19c9fd78b2f77e04e5045d75b47b46ae.png', 'image', '12,11,8', '1', '1', '2022-02-18', '01:12:55'),
(39, 'kelas', '12', 'ini file txt', '99920c409f91bc0bf293297b2ae4661c.txt', 'text', '12,11,8', '1', '1', '2022-02-18', '01:56:42'),
(44, 'materi', '12', 'ini materi spongebob squarepants', '', '', '12,8,11', '19', '1', '2022-02-18', '21:39:56'),
(47, 'materi', '12', 'iki donat masseh', '311565e9f1def5da46daa62a06d86bce.png', 'image', '12,8,11', '19', '1', '2022-02-18', '21:42:35'),
(51, 'kelompok', '12', 'test gambar kelompok mawar404 masseh', '2579d0949f2473aebe68e3b902361629.png', 'image', '12,8,11', '1', '1', '2022-02-19', '07:47:13'),
(52, 'kelompok', '11', 'test live chat masseh', '', '', '11,12,8', '1', '1', '2022-02-19', '07:47:13'),
(54, 'kelas', '8', 'testing diskusi kelas dari dosen bestie', '', '', '8,11', '1', '1', '2022-04-05', '19:57:34'),
(59, 'materi', '8', 'testing diskusi materi dari dosen bestie', '', '', '8', '19', '1', '2022-04-05', '22:25:46'),
(60, 'kelompok', '8', 'testing diskusi kelompok dari dosen bestie', '', '', '8', '1', '1', '2022-04-05', '22:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `t_formative`
--

CREATE TABLE `t_formative` (
  `formative_id` text NOT NULL,
  `formative_pelaksanaan` datetime DEFAULT NULL,
  `formative_judul` text NOT NULL,
  `formative_durasi` text NOT NULL,
  `formative_petunjuk` text NOT NULL,
  `formative_jumlah` text NOT NULL,
  `formative_pertanyaan` text NOT NULL,
  `formative_pelajaran` text NOT NULL,
  `formative_kelas` text NOT NULL,
  `formative_tanggal` date DEFAULT NULL,
  `formative_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_formative`
--

INSERT INTO `t_formative` (`formative_id`, `formative_pelaksanaan`, `formative_judul`, `formative_durasi`, `formative_petunjuk`, `formative_jumlah`, `formative_pertanyaan`, `formative_pelajaran`, `formative_kelas`, `formative_tanggal`, `formative_hapus`) VALUES
('SOAL1', '2022-04-03 18:34:00', 'Tebak gambar', '10', 'Jawab dengan hati yang bersih', '2', '{\"formative_judul\":\"Tebak gambar\",\"formative_pelajaran\":\"1\",\"formative_kelas\":[\"1\",\"2\",\"3\"],\"formative_pelaksanaan\":\"2022-04-03T18:34:00\",\"formative_durasi\":\"10\",\"formative_petunjuk\":\"Jawab dengan hati yang bersih\",\"formative_id\":\"SOAL1\",\"formative_jumlah\":\"2\",\"soal_pertanyaan1\":\"Gambra apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Bulat enak bolong\",\"gambar2\":\"SOAL1_2\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"image\"}', '1', '1,2,3', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_formative_hasil`
--

CREATE TABLE `t_formative_hasil` (
  `formative_hasil_id` int(11) NOT NULL,
  `formative_hasil_siswa` text NOT NULL,
  `formative_hasil_soal` text NOT NULL,
  `formative_hasil_jawaban` text NOT NULL,
  `formative_hasil_nilai` text NOT NULL,
  `formative_hasil_sisa` text NOT NULL,
  `formative_hasil_tanggal` date DEFAULT curdate(),
  `formative_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_formative_hasil`
--

INSERT INTO `t_formative_hasil` (`formative_hasil_id`, `formative_hasil_siswa`, `formative_hasil_soal`, `formative_hasil_jawaban`, `formative_hasil_nilai`, `formative_hasil_sisa`, `formative_hasil_tanggal`, `formative_hasil_hapus`) VALUES
(28, '11', 'SOAL1', '[\"D\",\"D\"]', '100', '9 menit : 50 detik', '2022-04-03', 0),
(29, '11', 'SOAL1', '[\"D\",\"C\"]', '50', '9 menit : 55 detik', '2022-04-03', 0),
(30, '11', 'SOAL1', '[\"D\",\"C\"]', '50', '9 menit : 52 detik', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_informasi`
--

CREATE TABLE `t_informasi` (
  `informasi_id` int(11) NOT NULL,
  `informasi_user` text NOT NULL,
  `informasi_mata_kuliah` text NOT NULL,
  `informasi_sks` text NOT NULL,
  `informasi_deskripsi` text NOT NULL,
  `informasi_relevansi` text NOT NULL,
  `informasi_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_informasi`
--

INSERT INTO `t_informasi` (`informasi_id`, `informasi_user`, `informasi_mata_kuliah`, `informasi_sks`, `informasi_deskripsi`, `informasi_relevansi`, `informasi_tanggal`) VALUES
(1, '5', 'Teknik Informartika', '10', 'Deskripsi', 'Relevansi', '2022-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas_nama` text NOT NULL,
  `kelas_kepanjangan` text NOT NULL,
  `kelas_hapus` int(11) NOT NULL,
  `kelas_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`kelas_id`, `kelas_nama`, `kelas_kepanjangan`, `kelas_hapus`, `kelas_tanggal`) VALUES
(1, 'TKJ 1', 'Teknik Kerja Jaringan 1', 0, '2021-04-05'),
(2, 'ATPH', 'Agribisnis Tanaman Pangan dan Holtikultura', 0, '2021-04-15'),
(3, 'TKJ 2', 'Teknik Kerja Jaringan 2', 0, '2021-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelompok`
--

CREATE TABLE `t_kelompok` (
  `kelompok_id` int(11) NOT NULL,
  `kelompok_nama` text NOT NULL,
  `kelompok_kelas` text NOT NULL,
  `kelompok_siswa` text NOT NULL,
  `kelompok_hapus` int(11) NOT NULL DEFAULT 0,
  `kelompok_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kelompok`
--

INSERT INTO `t_kelompok` (`kelompok_id`, `kelompok_nama`, `kelompok_kelas`, `kelompok_siswa`, `kelompok_hapus`, `kelompok_tanggal`) VALUES
(1, 'Mawar 404', '1', '11,12', 0, '2022-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `t_latihan`
--

CREATE TABLE `t_latihan` (
  `latihan_id` text NOT NULL,
  `latihan_semester` text NOT NULL,
  `latihan_pertemuan` text NOT NULL,
  `latihan_judul` text NOT NULL,
  `latihan_jenis` set('individu','kelompok') NOT NULL DEFAULT '',
  `latihan_tampil` date DEFAULT NULL,
  `latihan_batas_unggah` datetime DEFAULT NULL,
  `latihan_guru` text NOT NULL,
  `latihan_kelas` text NOT NULL,
  `latihan_pelajaran` text NOT NULL,
  `latihan_jumlah` text NOT NULL,
  `latihan_text` text NOT NULL,
  `latihan_tanggal` date NOT NULL DEFAULT curdate(),
  `latihan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_latihan`
--

INSERT INTO `t_latihan` (`latihan_id`, `latihan_semester`, `latihan_pertemuan`, `latihan_judul`, `latihan_jenis`, `latihan_tampil`, `latihan_batas_unggah`, `latihan_guru`, `latihan_kelas`, `latihan_pelajaran`, `latihan_jumlah`, `latihan_text`, `latihan_tanggal`, `latihan_hapus`) VALUES
('SOAL1', '1', '1', 'Menebak nama gambar', 'individu', '2022-04-03', '2022-04-03 05:24:00', 'SOAL1', '1,2,3', '1', '2', '{\"latihan_jumlah\":\"2\",\"latihan_id\":\"SOAL1\",\"latihan_judul\":\"Menebak nama gambar\",\"latihan_pelajaran\":\"1\",\"latihan_kelas\":[\"1\",\"2\",\"3\"],\"latihan_tampil\":\"2022-04-03\",\"latihan_batas_unggah\":\"2022-04-03T05:24\",\"latihan_jenis\":\"individu\",\"soal1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"soal2\":\"Soal materi ada di file\",\"gambar2\":\"SOAL1_2\",\"file2\":\"SOAL1_2.docx\",\"file1\":null}', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_latihan_hasil`
--

CREATE TABLE `t_latihan_hasil` (
  `latihan_hasil_id` int(11) NOT NULL,
  `latihan_hasil_jenis` text NOT NULL,
  `latihan_hasil_kelompok` text DEFAULT NULL,
  `latihan_hasil_siswa` text NOT NULL,
  `latihan_hasil_soal` text NOT NULL,
  `latihan_hasil_jawaban` text NOT NULL,
  `latihan_hasil_nilai` text NOT NULL,
  `latihan_hasil_nilai_total` text NOT NULL,
  `latihan_hasil_pengkoreksi` text NOT NULL,
  `latihan_hasil_tanggal` date NOT NULL DEFAULT curdate(),
  `latihan_hasil_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_latihan_hasil`
--

INSERT INTO `t_latihan_hasil` (`latihan_hasil_id`, `latihan_hasil_jenis`, `latihan_hasil_kelompok`, `latihan_hasil_siswa`, `latihan_hasil_soal`, `latihan_hasil_jawaban`, `latihan_hasil_nilai`, `latihan_hasil_nilai_total`, `latihan_hasil_pengkoreksi`, `latihan_hasil_tanggal`, `latihan_hasil_hapus`) VALUES
(9, 'individu', NULL, '11', 'SOAL1', '{\"latihan_id\":\"SOAL1\",\"latihan_jumlah\":\"2\",\"latihan_jenis\":\"individu\",\"jawab1\":\"Donat Kentang\",\"jawab2\":\"Jawaban ada di file\",\"jawab2_file\":\"SOAL1_2_jawab.docx\"}', '{\"jumlah\":\"2\",\"nilai1\":\"100\",\"nilai2\":\"80\"}', '180', '8', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_materi`
--

CREATE TABLE `t_materi` (
  `materi_id` int(11) NOT NULL,
  `materi_user` int(11) DEFAULT NULL,
  `materi_pelajaran` text DEFAULT NULL,
  `materi_kelas` text DEFAULT NULL,
  `materi_judul` text DEFAULT NULL,
  `materi_isi` text DEFAULT NULL,
  `materi_file` text DEFAULT NULL,
  `materi_hapus` int(11) DEFAULT 0,
  `materi_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_materi`
--

INSERT INTO `t_materi` (`materi_id`, `materi_user`, `materi_pelajaran`, `materi_kelas`, `materi_judul`, `materi_isi`, `materi_file`, `materi_hapus`, `materi_tanggal`) VALUES
(19, 5, '1', '1,2,3', 'Menebak nama gambar', '<p>Gambar adalah gambar dan harus di tebak dengan hati yang bersih dan tanpa pamrih</p>\r\n', '5bdb3834d77ee96d1fbd6073aaf47fe3.docx', 0, '2022-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_modul`
--

CREATE TABLE `t_modul` (
  `modul_id` int(11) NOT NULL,
  `modul_user` text NOT NULL,
  `modul_pelajaran` text NOT NULL,
  `modul_kelas` text NOT NULL,
  `modul_judul` text NOT NULL,
  `modul_isi` text NOT NULL,
  `modul_file` text NOT NULL,
  `modul_hapus` int(11) NOT NULL DEFAULT 0,
  `modul_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_modul`
--

INSERT INTO `t_modul` (`modul_id`, `modul_user`, `modul_pelajaran`, `modul_kelas`, `modul_judul`, `modul_isi`, `modul_file`, `modul_hapus`, `modul_tanggal`) VALUES
(1, '5', '1', '1,2,3', 'test modul', '<p>test modul</p>\r\n', 'f52ef74255427ce29f4ff518b6d7aedc.docx', 0, '2022-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_panduan`
--

CREATE TABLE `t_panduan` (
  `panduan_id` int(11) NOT NULL,
  `panduan_video` text NOT NULL,
  `panduan_file` text NOT NULL,
  `panduan_for` set('dosen','mahasiswa') NOT NULL DEFAULT '',
  `panduan_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_panduan`
--

INSERT INTO `t_panduan` (`panduan_id`, `panduan_video`, `panduan_file`, `panduan_for`, `panduan_tanggal`) VALUES
(1, 'iOUQEg9soWk', 'panduan_dosen.pdf', 'dosen', '2022-04-10'),
(2, 'RRgqNM0_fsg', '', 'mahasiswa', '2022-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelajaran`
--

CREATE TABLE `t_pelajaran` (
  `pelajaran_id` int(11) NOT NULL,
  `pelajaran_nama` text NOT NULL,
  `pelajaran_hapus` int(11) NOT NULL DEFAULT 0,
  `pelajaran_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pelajaran`
--

INSERT INTO `t_pelajaran` (`pelajaran_id`, `pelajaran_nama`, `pelajaran_hapus`, `pelajaran_tanggal`) VALUES
(1, 'Pemrograman dasar', 0, '2021-04-05'),
(2, 'Web Design', 0, '2021-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `t_pertemuan`
--

CREATE TABLE `t_pertemuan` (
  `pertemuan_id` int(11) NOT NULL,
  `pertemuan_no` text NOT NULL,
  `pertemuan_semester` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pertemuan`
--

INSERT INTO `t_pertemuan` (`pertemuan_id`, `pertemuan_no`, `pertemuan_semester`) VALUES
(76, '1', '1'),
(77, '2', '1'),
(78, '3', '1'),
(79, '4', '1'),
(80, '5', '1'),
(81, '6', '1'),
(82, '7', '1'),
(83, '8', '1'),
(84, '9', '1'),
(85, '10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_peta`
--

CREATE TABLE `t_peta` (
  `peta_id` int(11) NOT NULL,
  `peta_pelajaran` text NOT NULL,
  `peta_user` text NOT NULL,
  `peta_kelas` text NOT NULL,
  `peta_isi` text NOT NULL,
  `peta_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_peta`
--

INSERT INTO `t_peta` (`peta_id`, `peta_pelajaran`, `peta_user`, `peta_kelas`, `peta_isi`, `peta_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>edit</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2022-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_pilihan`
--

CREATE TABLE `t_pilihan` (
  `pilihan_id` text NOT NULL DEFAULT '',
  `pilihan_acak` set('ya','tidak') NOT NULL DEFAULT '',
  `pilihan_guru` text NOT NULL,
  `pilihan_judul` text NOT NULL,
  `pilihan_jumlah` text NOT NULL,
  `pilihan_pertanyaan` text NOT NULL,
  `pilihan_kelas` text NOT NULL,
  `pilihan_pelajaran` text NOT NULL,
  `pilihan_hapus` int(11) NOT NULL DEFAULT 0,
  `pilihan_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pilihan`
--

INSERT INTO `t_pilihan` (`pilihan_id`, `pilihan_acak`, `pilihan_guru`, `pilihan_judul`, `pilihan_jumlah`, `pilihan_pertanyaan`, `pilihan_kelas`, `pilihan_pelajaran`, `pilihan_hapus`, `pilihan_tanggal`) VALUES
('SOAL1', '', '8', 'Tebak Gambar Makanan', '3', '{\"pilihan_judul\":\"Tebak Gambar Makanan\",\"pilihan_pelajaran\":\"1\",\"pilihan_kelas\":[\"1\",\"2\",\"3\"],\"pilihan_id\":\"SOAL1\",\"pilihan_jumlah\":\"3\",\"soal_pertanyaan1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_pertanyaan2\":\"Gambar apakah ini ?\",\"gambar2\":\"SOAL1_2\",\"a2\":\"Puding\",\"b2\":\"Es krim\",\"c2\":\"Pie Pisang\",\"d2\":\"Kue Leker\",\"soal_kunci_jawaban2\":\"B\",\"soal_pertanyaan3\":\"Gambar apakah ini ?\",\"gambar3\":\"SOAL1_3\",\"a3\":\"Semangka\",\"b3\":\"Bumi\",\"c3\":\"Gulali\",\"d3\":\"Es Krim\",\"soal_kunci_jawaban3\":\"C\"}', '1,2,3', '1', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_pilihan_hasil`
--

CREATE TABLE `t_pilihan_hasil` (
  `pilihan_hasil_id` int(11) NOT NULL,
  `pilihan_hasil_siswa` text NOT NULL,
  `pilihan_hasil_soal` text NOT NULL,
  `pilihan_hasil_jawaban` text NOT NULL,
  `pilihan_hasil_nilai` text NOT NULL,
  `pilihan_hasil_hapus` int(11) NOT NULL DEFAULT 0,
  `pilihan_hasil_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pilihan_hasil`
--

INSERT INTO `t_pilihan_hasil` (`pilihan_hasil_id`, `pilihan_hasil_siswa`, `pilihan_hasil_soal`, `pilihan_hasil_jawaban`, `pilihan_hasil_nilai`, `pilihan_hasil_hapus`, `pilihan_hasil_tanggal`) VALUES
(3, '12', 'SOAL1', '[\"D\",\"B\",\"C\"]', '100', 0, '2022-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_post`
--

CREATE TABLE `t_post` (
  `post_id` text NOT NULL,
  `post_judul` text NOT NULL,
  `post_semester` text NOT NULL,
  `post_pertemuan` text NOT NULL,
  `post_pelaksanaan` datetime DEFAULT NULL,
  `post_durasi` text NOT NULL,
  `post_kesempatan` int(11) NOT NULL DEFAULT 2,
  `post_petunjuk` text NOT NULL,
  `post_jumlah` text NOT NULL,
  `post_pertanyaan` text NOT NULL,
  `post_pelajaran` text NOT NULL,
  `post_kelas` text NOT NULL,
  `post_tanggal` date DEFAULT NULL,
  `post_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_post`
--

INSERT INTO `t_post` (`post_id`, `post_judul`, `post_semester`, `post_pertemuan`, `post_pelaksanaan`, `post_durasi`, `post_kesempatan`, `post_petunjuk`, `post_jumlah`, `post_pertanyaan`, `post_pelajaran`, `post_kelas`, `post_tanggal`, `post_hapus`) VALUES
('SOAL1', 'Tebak gambar', '1', '1', '2022-04-03 08:12:00', '10', 2, 'Jawab pertanyaan setelah cuci tangan', '2', '{\"post_judul\":\"Tebak gambar\",\"post_pelajaran\":\"1\",\"post_kelas\":[\"1\",\"2\",\"3\"],\"post_pelaksanaan\":\"2022-04-03T08:12:00\",\"post_durasi\":\"10\",\"post_kesempatan\":\"2\",\"post_petunjuk\":\"Jawab pertanyaan setelah cuci tangan\",\"post_id\":\"SOAL1\",\"post_jumlah\":\"2\",\"soal_pertanyaan1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Bulat manis bolong\",\"gambar2\":\"SOAL1_2\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"image\"}', '1', '1,2,3', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_post_hasil`
--

CREATE TABLE `t_post_hasil` (
  `post_hasil_id` int(11) NOT NULL,
  `post_hasil_materi` text NOT NULL,
  `post_hasil_siswa` text NOT NULL,
  `post_hasil_soal` text NOT NULL,
  `post_hasil_jawaban` text NOT NULL,
  `post_hasil_nilai_1` text NOT NULL,
  `post_hasil_nilai_2` text NOT NULL,
  `post_hasil_sisa` text NOT NULL,
  `post_hasil_kesempatan` datetime NOT NULL DEFAULT current_timestamp(),
  `post_hasil_tanggal` date DEFAULT curdate(),
  `post_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_post_hasil`
--

INSERT INTO `t_post_hasil` (`post_hasil_id`, `post_hasil_materi`, `post_hasil_siswa`, `post_hasil_soal`, `post_hasil_jawaban`, `post_hasil_nilai_1`, `post_hasil_nilai_2`, `post_hasil_sisa`, `post_hasil_kesempatan`, `post_hasil_tanggal`, `post_hasil_hapus`) VALUES
(30, '', '11', 'SOAL1', '[\"C\",\"D\"]', '100', '50', '9 menit : 49 detik', '2022-04-03 08:31:35', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pre`
--

CREATE TABLE `t_pre` (
  `pre_id` text NOT NULL,
  `pre_judul` text NOT NULL,
  `pre_semester` text NOT NULL,
  `pre_pertemuan` text NOT NULL,
  `pre_pelaksanaan` datetime DEFAULT NULL,
  `pre_durasi` text NOT NULL,
  `pre_petunjuk` text NOT NULL,
  `pre_jumlah` text NOT NULL,
  `pre_pertanyaan` text NOT NULL,
  `pre_pelajaran` text NOT NULL,
  `pre_kelas` text NOT NULL,
  `pre_tanggal` date DEFAULT NULL,
  `pre_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pre`
--

INSERT INTO `t_pre` (`pre_id`, `pre_judul`, `pre_semester`, `pre_pertemuan`, `pre_pelaksanaan`, `pre_durasi`, `pre_petunjuk`, `pre_jumlah`, `pre_pertanyaan`, `pre_pelajaran`, `pre_kelas`, `pre_tanggal`, `pre_hapus`) VALUES
('SOAL1', 'Tebak gambar', '1', '1', '2022-04-04 10:41:00', '10', 'Jawab dengan logika 100%', '2', '{\"pre_semester\":\"1\",\"pre_pertemuan\":\"1\",\"pre_judul\":\"Tebak gambar\",\"pre_pelajaran\":\"1\",\"pre_kelas\":[\"1\",\"2\",\"3\"],\"pre_pelaksanaan\":\"2022-04-04T10:41\",\"pre_durasi\":\"10\",\"pre_petunjuk\":\"Jawab dengan logika 100%\",\"pre_id\":\"SOAL1\",\"pre_jumlah\":\"2\",\"soal_pertanyaan1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Bulat enak bolong ?\",\"gambar2\":\"SOAL1_2\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"image\"}', '1', '1,2,3', '2022-04-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pre_hasil`
--

CREATE TABLE `t_pre_hasil` (
  `pre_hasil_id` int(11) NOT NULL,
  `pre_hasil_siswa` text NOT NULL,
  `pre_hasil_soal` text NOT NULL,
  `pre_hasil_jawaban` text NOT NULL,
  `pre_hasil_nilai` text NOT NULL,
  `pre_hasil_sisa` text NOT NULL,
  `pre_hasil_tanggal` date DEFAULT curdate(),
  `pre_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pre_hasil`
--

INSERT INTO `t_pre_hasil` (`pre_hasil_id`, `pre_hasil_siswa`, `pre_hasil_soal`, `pre_hasil_jawaban`, `pre_hasil_nilai`, `pre_hasil_sisa`, `pre_hasil_tanggal`, `pre_hasil_hapus`) VALUES
(31, '11', 'SOAL1', '[\"D\",\"D\"]', '100', '9 menit : 52 detik', '2022-04-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_rencana`
--

CREATE TABLE `t_rencana` (
  `rencana_id` int(11) NOT NULL,
  `rencana_pelajaran` text NOT NULL,
  `rencana_user` text NOT NULL,
  `rencana_kelas` text NOT NULL,
  `rencana_isi` text NOT NULL,
  `rencana_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_rencana`
--

INSERT INTO `t_rencana` (`rencana_id`, `rencana_pelajaran`, `rencana_user`, `rencana_kelas`, `rencana_isi`, `rencana_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>edit</p>\r\n', '2022-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_semester`
--

CREATE TABLE `t_semester` (
  `semester_id` int(11) NOT NULL,
  `semester_no` text NOT NULL,
  `semester_pertemuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_semester`
--

INSERT INTO `t_semester` (`semester_id`, `semester_no`, `semester_pertemuan`) VALUES
(6, '1', '10');

-- --------------------------------------------------------

--
-- Table structure for table `t_tujuan`
--

CREATE TABLE `t_tujuan` (
  `tujuan_id` int(11) NOT NULL,
  `tujuan_pelajaran` text NOT NULL,
  `tujuan_user` text NOT NULL,
  `tujuan_kelas` text NOT NULL,
  `tujuan_isi` text NOT NULL,
  `tujuan_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_tujuan`
--

INSERT INTO `t_tujuan` (`tujuan_id`, `tujuan_pelajaran`, `tujuan_user`, `tujuan_kelas`, `tujuan_isi`, `tujuan_tanggal`) VALUES
(1, '1', '8', '1,2,3', '<p>Belajar adalah jalan ninjaku</p>\r\n', '2022-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_ujian_essay`
--

CREATE TABLE `t_ujian_essay` (
  `ujian_essay_id` text NOT NULL,
  `ujian_essay_pelaksanaan` datetime DEFAULT NULL,
  `ujian_essay_judul` text NOT NULL,
  `ujian_essay_semester` text NOT NULL,
  `ujian_essay_pertemuan` text NOT NULL,
  `ujian_essay_durasi` text NOT NULL,
  `ujian_essay_petunjuk` text NOT NULL,
  `ujian_essay_guru` text NOT NULL,
  `ujian_essay_kelas` text NOT NULL,
  `ujian_essay_pelajaran` text NOT NULL,
  `ujian_essay_jumlah` text NOT NULL,
  `ujian_essay_text` text NOT NULL,
  `ujian_essay_tanggal` date DEFAULT curdate(),
  `ujian_essay_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_ujian_essay`
--

INSERT INTO `t_ujian_essay` (`ujian_essay_id`, `ujian_essay_pelaksanaan`, `ujian_essay_judul`, `ujian_essay_semester`, `ujian_essay_pertemuan`, `ujian_essay_durasi`, `ujian_essay_petunjuk`, `ujian_essay_guru`, `ujian_essay_kelas`, `ujian_essay_pelajaran`, `ujian_essay_jumlah`, `ujian_essay_text`, `ujian_essay_tanggal`, `ujian_essay_hapus`) VALUES
('SOAL1', '2022-04-03 22:45:00', 'Tebak Gambar', '1', '1', '10', 'Jawablah dengan hati yang iklash', '8', '1,2,3', '1', '2', '{\"ujian_essay_jumlah\":\"2\",\"ujian_essay_id\":\"SOAL1\",\"ujian_essay_semester\":\"1\",\"ujian_essay_pertemuan\":\"1\",\"ujian_essay_judul\":\"Tebak Gambar\",\"ujian_essay_pelajaran\":\"1\",\"ujian_essay_kelas\":[\"1\",\"2\",\"3\"],\"ujian_essay_pelaksanaan\":\"2022-04-03T22:45\",\"ujian_essay_durasi\":\"10\",\"ujian_essay_petunjuk\":\"Jawablah dengan hati yang iklash\",\"soal1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"soal2\":\"Gambar apakah ini ?\",\"gambar2\":\"SOAL1_2\"}', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_ujian_essay_hasil`
--

CREATE TABLE `t_ujian_essay_hasil` (
  `ujian_essay_hasil_id` int(11) NOT NULL,
  `ujian_essay_hasil_durasi_sisa` text NOT NULL,
  `ujian_essay_hasil_siswa` text NOT NULL,
  `ujian_essay_hasil_soal` text NOT NULL,
  `ujian_essay_hasil_jawaban` text NOT NULL,
  `ujian_essay_hasil_nilai` text NOT NULL,
  `ujian_essay_hasil_nilai_total` text NOT NULL,
  `ujian_essay_hasil_pengkoreksi` text NOT NULL,
  `ujian_essay_hasil_tanggal` date NOT NULL DEFAULT curdate(),
  `ujian_essay_hasil_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_ujian_essay_hasil`
--

INSERT INTO `t_ujian_essay_hasil` (`ujian_essay_hasil_id`, `ujian_essay_hasil_durasi_sisa`, `ujian_essay_hasil_siswa`, `ujian_essay_hasil_soal`, `ujian_essay_hasil_jawaban`, `ujian_essay_hasil_nilai`, `ujian_essay_hasil_nilai_total`, `ujian_essay_hasil_pengkoreksi`, `ujian_essay_hasil_tanggal`, `ujian_essay_hasil_hapus`) VALUES
(8, '9 menit : 44 detik', '11', 'SOAL1', '{\"id\":\"SOAL1\",\"timer\":\"9 menit : 44 detik\",\"jawab1\":\"Donat Meses\",\"jawab2\":\"Donat Kentang\"}', '{\"jumlah\":\"2\",\"nilai1\":\"10\",\"nilai2\":\"10\"}', '20', '8', '2022-04-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_ujian_pilihan`
--

CREATE TABLE `t_ujian_pilihan` (
  `ujian_pilihan_id` text NOT NULL,
  `ujian_pilihan_pelaksanaan` datetime DEFAULT NULL,
  `ujian_pilihan_judul` text NOT NULL,
  `ujian_pilihan_semester` text NOT NULL,
  `ujian_pilihan_pertemuan` text NOT NULL,
  `ujian_pilihan_durasi` text NOT NULL,
  `ujian_pilihan_kesempatan` text NOT NULL,
  `ujian_pilihan_petunjuk` text NOT NULL,
  `ujian_pilihan_jumlah` text NOT NULL,
  `ujian_pilihan_pertanyaan` text NOT NULL,
  `ujian_pilihan_pelajaran` text NOT NULL,
  `ujian_pilihan_kelas` text NOT NULL,
  `ujian_pilihan_tanggal` date DEFAULT NULL,
  `ujian_pilihan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ujian_pilihan`
--

INSERT INTO `t_ujian_pilihan` (`ujian_pilihan_id`, `ujian_pilihan_pelaksanaan`, `ujian_pilihan_judul`, `ujian_pilihan_semester`, `ujian_pilihan_pertemuan`, `ujian_pilihan_durasi`, `ujian_pilihan_kesempatan`, `ujian_pilihan_petunjuk`, `ujian_pilihan_jumlah`, `ujian_pilihan_pertanyaan`, `ujian_pilihan_pelajaran`, `ujian_pilihan_kelas`, `ujian_pilihan_tanggal`, `ujian_pilihan_hapus`) VALUES
('SOAL1', '2022-04-03 23:38:00', 'Tebak gambar', '1', '1', '10', '2', 'Jawablah dengan hati yang suci', '2', '{\"ujian_pilihan_judul\":\"Tebak gambar\",\"ujian_pilihan_pelajaran\":\"1\",\"ujian_pilihan_pelaksanaan\":\"2022-04-03T23:38:00\",\"ujian_pilihan_durasi\":\"10\",\"ujian_pilihan_kesempatan\":\"2\",\"ujian_pilihan_kelas\":[\"1\",\"2\",\"3\"],\"ujian_pilihan_petunjuk\":\"Jawablah dengan hati yang suci\",\"ujian_pilihan_id\":\"SOAL1\",\"ujian_pilihan_jumlah\":\"2\",\"soal_pertanyaan1\":\"Gambar apakah ini ?\",\"gambar1\":\"SOAL1_1\",\"a1\":\"Jagung Bakar\",\"b1\":\"Permen\",\"c1\":\"Yakult\",\"d1\":\"Donat\",\"soal_kunci_jawaban1\":\"D\",\"soal_input1\":\"text\",\"soal_pertanyaan2\":\"Bulat enak bolong ?\",\"gambar2\":\"SOAL1_2\",\"soal_kunci_jawaban2\":\"D\",\"soal_input2\":\"image\"}', '1', '1,2,3', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_ujian_pilihan_hasil`
--

CREATE TABLE `t_ujian_pilihan_hasil` (
  `ujian_pilihan_hasil_id` int(11) NOT NULL,
  `ujian_pilihan_hasil_materi` text NOT NULL,
  `ujian_pilihan_hasil_siswa` text NOT NULL,
  `ujian_pilihan_hasil_soal` text NOT NULL,
  `ujian_pilihan_hasil_jawaban` text NOT NULL,
  `ujian_pilihan_hasil_nilai` text NOT NULL,
  `ujian_pilihan_hasil_sisa` text NOT NULL,
  `ujian_pilihan_hasil_kesempatan` text NOT NULL,
  `ujian_pilihan_hasil_tanggal` date DEFAULT curdate(),
  `ujian_pilihan_hasil_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ujian_pilihan_hasil`
--

INSERT INTO `t_ujian_pilihan_hasil` (`ujian_pilihan_hasil_id`, `ujian_pilihan_hasil_materi`, `ujian_pilihan_hasil_siswa`, `ujian_pilihan_hasil_soal`, `ujian_pilihan_hasil_jawaban`, `ujian_pilihan_hasil_nilai`, `ujian_pilihan_hasil_sisa`, `ujian_pilihan_hasil_kesempatan`, `ujian_pilihan_hasil_tanggal`, `ujian_pilihan_hasil_hapus`) VALUES
(27, '', '11', 'SOAL1', '[\"D\",\"D\"]', '100', '9 menit : 46 detik', '1', '2022-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_ttl` date DEFAULT NULL,
  `user_nohp` text DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_biodata` text DEFAULT NULL,
  `user_foto` text DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_pelajaran` text DEFAULT NULL,
  `user_kelas` text DEFAULT NULL,
  `user_email_2` text DEFAULT NULL,
  `user_tanggal` date DEFAULT curdate(),
  `user_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin ( Eclassroom )', '2021-11-09', '085555111555', 'Alamat', 'Biodata', NULL, 1, NULL, NULL, NULL, '2021-11-28', 0),
(8, '1111', 'b59c67bf196a4758191e42f76670ceba', 'Madun', '0000-00-00', '', '', '', NULL, 2, '1', NULL, NULL, '2021-11-30', 0),
(9, '2222', '934b535800b1cba8f96a5d72f72f1611', 'Valentino Rossi', NULL, NULL, NULL, NULL, NULL, 2, '2', NULL, NULL, '2021-11-28', 0),
(11, '3333', '2be9bd7a3434f7038ca27d1918de58bd', 'Uciha Sasuke', NULL, NULL, NULL, NULL, 'Riandaka_4.png', 3, NULL, '1', 'sasuke@gmail.com', '2021-11-28', 0),
(12, '4444', 'dbc4d84bfcfe2284ba11beffb853a8c4', 'Uzumaki Naruto', NULL, NULL, NULL, NULL, NULL, 3, NULL, '1', 'uzumaki@gmail.com', '2021-11-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_video`
--

CREATE TABLE `t_video` (
  `video_id` int(11) NOT NULL,
  `video_judul` text DEFAULT NULL,
  `video_album` text DEFAULT NULL,
  `video_foto` text DEFAULT NULL,
  `video_link` text DEFAULT NULL,
  `video_tanggal` date DEFAULT NULL,
  `video_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_video`
--

INSERT INTO `t_video` (`video_id`, `video_judul`, `video_album`, `video_foto`, `video_link`, `video_tanggal`, `video_hapus`) VALUES
(5, 'KINGDOM ANIMALIA - Kerajaan Hewan || Materi IPA kelas 7', '3', 'PositifOtaku_Ano_hana_1.jpg', 'XFJL4NLmxOs', '2019-12-28', 0),
(6, 'Jenis dan Ciri-ciri Hewan Vertebrata', '3', NULL, '-kWqUQJywgU', '2021-04-03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_album`
--
ALTER TABLE `t_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `t_assigment`
--
ALTER TABLE `t_assigment`
  ADD PRIMARY KEY (`assigment_id`);

--
-- Indexes for table `t_assigment_hasil`
--
ALTER TABLE `t_assigment_hasil`
  ADD PRIMARY KEY (`assigment_hasil_id`);

--
-- Indexes for table `t_chat`
--
ALTER TABLE `t_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `t_collassion`
--
ALTER TABLE `t_collassion`
  ADD PRIMARY KEY (`collassion_id`);

--
-- Indexes for table `t_diskusi`
--
ALTER TABLE `t_diskusi`
  ADD PRIMARY KEY (`diskusi_id`);

--
-- Indexes for table `t_formative_hasil`
--
ALTER TABLE `t_formative_hasil`
  ADD PRIMARY KEY (`formative_hasil_id`);

--
-- Indexes for table `t_informasi`
--
ALTER TABLE `t_informasi`
  ADD PRIMARY KEY (`informasi_id`);

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `t_kelompok`
--
ALTER TABLE `t_kelompok`
  ADD PRIMARY KEY (`kelompok_id`);

--
-- Indexes for table `t_latihan_hasil`
--
ALTER TABLE `t_latihan_hasil`
  ADD PRIMARY KEY (`latihan_hasil_id`);

--
-- Indexes for table `t_materi`
--
ALTER TABLE `t_materi`
  ADD PRIMARY KEY (`materi_id`);

--
-- Indexes for table `t_modul`
--
ALTER TABLE `t_modul`
  ADD PRIMARY KEY (`modul_id`);

--
-- Indexes for table `t_panduan`
--
ALTER TABLE `t_panduan`
  ADD PRIMARY KEY (`panduan_id`);

--
-- Indexes for table `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  ADD PRIMARY KEY (`pelajaran_id`);

--
-- Indexes for table `t_pertemuan`
--
ALTER TABLE `t_pertemuan`
  ADD PRIMARY KEY (`pertemuan_id`);

--
-- Indexes for table `t_peta`
--
ALTER TABLE `t_peta`
  ADD PRIMARY KEY (`peta_id`);

--
-- Indexes for table `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  ADD PRIMARY KEY (`pilihan_hasil_id`);

--
-- Indexes for table `t_post_hasil`
--
ALTER TABLE `t_post_hasil`
  ADD PRIMARY KEY (`post_hasil_id`);

--
-- Indexes for table `t_pre_hasil`
--
ALTER TABLE `t_pre_hasil`
  ADD PRIMARY KEY (`pre_hasil_id`);

--
-- Indexes for table `t_rencana`
--
ALTER TABLE `t_rencana`
  ADD PRIMARY KEY (`rencana_id`);

--
-- Indexes for table `t_semester`
--
ALTER TABLE `t_semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `t_tujuan`
--
ALTER TABLE `t_tujuan`
  ADD PRIMARY KEY (`tujuan_id`);

--
-- Indexes for table `t_ujian_essay_hasil`
--
ALTER TABLE `t_ujian_essay_hasil`
  ADD PRIMARY KEY (`ujian_essay_hasil_id`);

--
-- Indexes for table `t_ujian_pilihan_hasil`
--
ALTER TABLE `t_ujian_pilihan_hasil`
  ADD PRIMARY KEY (`ujian_pilihan_hasil_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_album`
--
ALTER TABLE `t_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_assigment`
--
ALTER TABLE `t_assigment`
  MODIFY `assigment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_assigment_hasil`
--
ALTER TABLE `t_assigment_hasil`
  MODIFY `assigment_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_chat`
--
ALTER TABLE `t_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `t_collassion`
--
ALTER TABLE `t_collassion`
  MODIFY `collassion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_diskusi`
--
ALTER TABLE `t_diskusi`
  MODIFY `diskusi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `t_formative_hasil`
--
ALTER TABLE `t_formative_hasil`
  MODIFY `formative_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_informasi`
--
ALTER TABLE `t_informasi`
  MODIFY `informasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_kelompok`
--
ALTER TABLE `t_kelompok`
  MODIFY `kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_latihan_hasil`
--
ALTER TABLE `t_latihan_hasil`
  MODIFY `latihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_materi`
--
ALTER TABLE `t_materi`
  MODIFY `materi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_modul`
--
ALTER TABLE `t_modul`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_panduan`
--
ALTER TABLE `t_panduan`
  MODIFY `panduan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pelajaran`
--
ALTER TABLE `t_pelajaran`
  MODIFY `pelajaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_pertemuan`
--
ALTER TABLE `t_pertemuan`
  MODIFY `pertemuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_peta`
--
ALTER TABLE `t_peta`
  MODIFY `peta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pilihan_hasil`
--
ALTER TABLE `t_pilihan_hasil`
  MODIFY `pilihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_post_hasil`
--
ALTER TABLE `t_post_hasil`
  MODIFY `post_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_pre_hasil`
--
ALTER TABLE `t_pre_hasil`
  MODIFY `pre_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_rencana`
--
ALTER TABLE `t_rencana`
  MODIFY `rencana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_semester`
--
ALTER TABLE `t_semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_tujuan`
--
ALTER TABLE `t_tujuan`
  MODIFY `tujuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_ujian_essay_hasil`
--
ALTER TABLE `t_ujian_essay_hasil`
  MODIFY `ujian_essay_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_ujian_pilihan_hasil`
--
ALTER TABLE `t_ujian_pilihan_hasil`
  MODIFY `ujian_pilihan_hasil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_video`
--
ALTER TABLE `t_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
