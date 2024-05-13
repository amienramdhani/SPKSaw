<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PSaw_model extends CI_Model
{
    public function getEmail()
    {
        return $this->db
            ->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();
    }

    public function getSiswa()
    {
        return $this->db->get('data_siswa')->result_array();
    }

    public function getKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function getNilaisiswa()
    {
        return $this->db->get('nilai_siswa')->result_array();
    }

    public function getNilai()
    {
        return $this->db->get('nilai')->result_array();
    }

    public function getNilaiPeminatan()
    {
        return $this->db->get('nilai_peminatan')->result_array();
    }

    //fungsi yang digunakan untuk mengambil id jurusan dari tabel jurusan, yang nantinya id jurusan digunakan untuk mengkonversi nilai - nilai yang dimasukkan.
    public function peminatan()
    {
        $this->db->select('id_peminatan');
        $this->db->from('peminatan');
        $query = $this->db->get();
        if ($query->num_rows()) {
            $peminatan = $query->result_array();
            foreach ($peminatan as $row => $author) {
                $this->db->insert('konversi_nilai', $author);
            }
        }
    }

    //fungsi yang digunakan untuk mengambil id siswa yang terkahir yang di inputkan, yang digunakan untuk mengkonversi nilai yang ada juga.
    public function ID()
    {
        $query =
            'SELECT `id_siswa` FROM `data_siswa` ORDER BY `id_siswa` DESC LIMIT 1';
        return $this->db->query($query)->result();
    }

    //fungsi tambah siswa baru
    public function tambahSiswa()
    {
        $kode = $this->cekKodeSiswa();
        $data = [
            'no_daftar' => $kode,
            'nama_siswa' => $this->input->post('nama_siswa', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'asal_sekolah' => $this->input->post('asal_sekolah', true),
            'alamat' => $this->input->post('alamat', true),
        ];
        $this->db->insert('data_siswa', $data);
        $this->peminatan();
        //insert_id digunakan untuk mengambil id yang dimasukkan, tapi hanya id nya saja.
        $id_siswa = $this->db->insert_id();
        $data2 = [
            'id_siswa' => $id_siswa,
        ];
        $this->db->insert('konversi_nilai', $data2);
        $query = $this->ID();
        //foreach yang digunakan untuk mengulangi id yang dimasukan sebanyak row yang ada.
        foreach ($query as $row) {
            $id = $row->id_siswa;
        }
        $dataN = [
            'id_siswa' => $id,
        ];
        $this->db->insert('nilai', $dataN);
        $this->db->set('id_siswa', $id);
        $this->db->where('id_siswa', 0);
        $this->db->update('konversi_nilai');
        //untuk menghapus id jurusan yang saat dimasukkan 0, karena di sistem ini tidak ada id jurusan 0.
        $this->db->where('id_peminatan', 0);
        $this->db->delete('konversi_nilai');
    }

    public function hapusSiswa($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->delete('data_siswa');
    }

    public function editSiswa()
    {
        $no_daftar = $this->input->post('no_daftar');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $asal_sekolah = $this->input->post('asal_sekolah');
        $alamat = $this->input->post('alamat');

        $data = [
            'no_daftar' => $no_daftar,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'asal_sekolah' => $asal_sekolah,
            'alamat' => $alamat,
        ];

        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('data_siswa', $data);
    }

    public function getJoinNilaiSiswa()
    {
        $queryNilaisiswa = "SELECT `data_siswa`.`id_siswa` ,`data_siswa`.`nama_siswa`, `data_siswa`.`no_daftar`, `nilai`.* 
        FROM `nilai` JOIN `data_siswa` ON `nilai`.`id_siswa` = `data_siswa`.`id_siswa` 
        WHERE `nilai`.`id_siswa` = `data_siswa`.`id_siswa`
        ";
        return $this->db->query($queryNilaisiswa)->result_array();
    }

    //fungsi yang digunakan untuk memasukkan nilai-nilai setiap siswa.
    public function inputNilai()
    {
        $c1 = $this->input->post('c1');
        $c2 = $this->input->post('c2');
        $c3 = $this->input->post('c3');
        $c4 = $this->input->post('c4');
        $c5 = $this->input->post('c5');
        $c6 = $this->input->post('c6');

        $data = [
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
        ];

        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('nilai', $data);
        $this->db->set($data);
        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        //ke tabel konversi nilai
        $this->db->update('konversi_nilai');

        $data2 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
        ];
        $this->db->set($data2);
        //dan ke tabel nilai jurusan
        $this->db->insert('nilai_peminatan');
    }

    //fungsi yang digunakan untuk mengkonversi dari nilai siswa menjadi nilai - nilai di matriks kecocokan
    public function inputKonversi()
    {
        //Software Development
        $c1sd = $this->C1sd();
        $c2sd = $this->C2sd();
        $c3sd = $this->C3sd();
        $c4sd = $this->C4sd();
        $c5sd = $this->C5sd();
        $c6sd = $this->C6sd();

        //NILAI Pemrograman
        if ($c1sd <= 30) {
            $c1sd = 1;
        } elseif ($c1sd > 30 && $c1sd <= 40) {
            $c1sd = 2;
        } elseif ($c1sd > 40 && $c1sd <= 60) {
            $c1sd = 3;
        } elseif ($c1sd > 60 && $c1sd <= 80) {
            $c1sd = 4;
        } elseif ($c1sd > 80 && $c1sd <= 100) {
            $c1sd = 5;
        }
        //NILAI PLC
        if ($c2sd <= 30) {
            $c2sd = 1;
        } elseif ($c2sd > 30 && $c2sd <= 40) {
            $c2sd = 2;
        } elseif ($c2sd > 40 && $c2sd <= 60) {
            $c2sd = 3;
        } elseif ($c2sd > 60 && $c2sd <= 80) {
            $c2sd = 4;
        } elseif ($c2sd > 80 && $c2sd <= 100) {
            $c2sd = 5;
        }
        //NILAI Pemrogramana Mobile
        if ($c3sd <= 35) {
            $c3sd = 1;
        } elseif ($c3sd > 35 && $c3sd <= 45) {
            $c3sd = 2;
        } elseif ($c3sd > 45 && $c3sd <= 65) {
            $c3sd = 3;
        } elseif ($c3sd > 65 && $c3sd <= 85) {
            $c3sd = 4;
        } elseif ($c3sd > 85 && $c3sd <= 100) {
            $c3sd = 5;
        }
        //NILAI Management Project
        if ($c4sd <= 35) {
            $c4sd = 1;
        } elseif ($c4sd > 35 && $c4sd <= 45) {
            $c4sd = 2;
        } elseif ($c4sd > 45 && $c4sd <= 65) {
            $c4sd = 3;
        } elseif ($c4sd > 65 && $c4sd <= 85) {
            $c4sd = 4;
        } elseif ($c4sd > 85 && $c4sd <= 100) {
            $c4sd = 5;
        }
        //NILAI Robotic
        if ($c5sd <= 35) {
            $c5sd = 1;
        } elseif ($c5sd > 35 && $c5sd <= 45) {
            $c5sd = 2;
        } elseif ($c5sd > 45 && $c5sd <= 65) {
            $c5sd = 3;
        } elseif ($c5sd > 65 && $c5sd <= 85) {
            $c5sd = 4;
        } elseif ($c5sd > 85 && $c5sd <= 100) {
            $c5sd = 5;
        }
        //NILAI Basis Data
        if ($c6sd <= 35) {
            $c6sd = 1;
        } elseif ($c6sd > 35 && $c6sd <= 45) {
            $c6sd = 2;
        } elseif ($c6sd > 45 && $c6sd <= 65) {
            $c6sd = 3;
        } elseif ($c6sd > 65 && $c6sd <= 85) {
            $c6sd = 4;
        } elseif ($c6sd > 85 && $c6sd <= 100) {
            $c6sd = 5;
        }

        //Data Science
        $c1ds = $this->C1ds();
        $c2ds = $this->C2ds();
        $c3ds = $this->C3ds();
        $c4ds = $this->C4ds();
        $c5ds = $this->C5ds();
        $c6ds = $this->C6ds();

        //NILAI Pemrograman
        if ($c1ds <= 40) {
            $c1ds = 1;
        } elseif ($c1ds > 40 && $c1ds <= 69) {
            $c1ds = 2;
        } elseif ($c1ds > 69 && $c1ds <= 88) {
            $c1ds = 3;
        } elseif ($c1ds > 88 && $c1ds <= 94) {
            $c1ds = 4;
        } elseif ($c1ds > 94 && $c1ds <= 100) {
            $c1ds = 5;
        }
        //NILAI PLC
        if ($c2ds <= 37) {
            $c2ds = 1;
        } elseif ($c2ds > 37 && $c2ds <= 64) {
            $c2ds = 2;
        } elseif ($c2ds > 64 && $c2ds <= 76) {
            $c2ds = 3;
        } elseif ($c2ds > 76 && $c2ds <= 84) {
            $c2ds = 4;
        } elseif ($c2ds > 84 && $c2ds <= 100) {
            $c2ds = 5;
        }
        //NILAI Pemrograman Mobile
        if ($c3ds <= 43) {
            $c3ds = 1;
        } elseif ($c3ds > 43 && $c3ds <= 65) {
            $c3ds = 2;
        } elseif ($c3ds > 65 && $c3ds <= 78) {
            $c3ds = 3;
        } elseif ($c3ds > 78 && $c3ds <= 87) {
            $c3ds = 4;
        } elseif ($c3ds > 87 && $c3ds <= 100) {
            $c3ds = 5;
        }
        //NILAI Management project
        if ($c4ds <= 25) {
            $c4ds = 1;
        } elseif ($c4ds > 25 && $c4ds <= 56) {
            $c4ds = 2;
        } elseif ($c4ds > 56 && $c4ds <= 77) {
            $c4ds = 3;
        } elseif ($c4ds > 77 && $c4ds <= 86) {
            $c4ds = 4;
        } elseif ($c4ds > 86 && $c4ds <= 100) {
            $c4ds = 5;
        }
        //NILAI Robotic
        if ($c5ds <= 40) {
            $c5ds = 1;
        } elseif ($c5ds > 40 && $c5ds <= 67) {
            $c5ds = 2;
        } elseif ($c5ds > 67 && $c5ds <= 77) {
            $c5ds = 3;
        } elseif ($c5ds > 77 && $c5ds <= 84) {
            $c5ds = 4;
        } elseif ($c5ds > 84 && $c5ds <= 100) {
            $c5ds = 5;
        }
        //NILAI Basis Data
        if ($c6ds <= 30) {
            $c6ds = 1;
        } elseif ($c6ds > 30 && $c6ds <= 48) {
            $c6ds = 2;
        } elseif ($c6ds > 48 && $c6ds <= 66) {
            $c6ds = 3;
        } elseif ($c6ds > 66 && $c6ds <= 79) {
            $c6ds = 4;
        } elseif ($c6ds > 79 && $c6ds <= 100) {
            $c6ds = 5;
        }

        // //Intelligent Systen Developer
        // $c1isd = $this->C1isd();
        // $c2isd = $this->C2isd();
        // $c3isd = $this->C3isd();
        // $c4isd = $this->C4isd();
        // $c5isd = $this->C5isd();
        // $c6isd = $this->C6isd();

        // //NILAI Pemrograman
        // if ($c1isd <= 25) {
        //     $c1isd = 1;
        // } elseif ($c1isd > 25 && $c1isd <= 45) {
        //     $c1isd = 2;
        // } elseif ($c1isd > 45 && $c1isd <= 65) {
        //     $c1isd = 3;
        // } elseif ($c1isd > 65 && $c1isd <= 85) {
        //     $c1isd = 4;
        // } elseif ($c1isd > 85 && $c1isd <= 100) {
        //     $c1isd = 5;
        // }

        // //NILAI PLC
        // if ($c2isd <= 20) {
        //     $c2isd = 1;
        // } elseif ($c2isd > 20 && $c2isd <= 58) {
        //     $c2isd = 2;
        // } elseif ($c2isd > 58 && $c2isd <= 70) {
        //     $c2isd = 3;
        // } elseif ($c2isd > 70 && $c2isd <= 88) {
        //     $c2isd = 4;
        // } elseif ($c2isd > 88 && $c2isd <= 100) {
        //     $c2isd = 5;
        // }
        // //NILAI Pemrograman Mobile
        // if ($c3isd <= 30) {
        //     $c3isd = 1;
        // } elseif ($c3isd > 30 && $c3isd <= 50) {
        //     $c3isd = 2;
        // } elseif ($c3isd > 50 && $c3isd <= 70) {
        //     $c3isd = 3;
        // } elseif ($c3isd > 70 && $c3isd <= 80) {
        //     $c3isd = 4;
        // } elseif ($c3isd > 80 && $c3isd <= 100) {
        //     $c3isd = 5;
        // }

        // //NILAI Management Project
        // if ($c4isd <= 25) {
        //     $c4isd = 1;
        // } elseif ($c4isd > 25 && $c4isd <= 55) {
        //     $c4isd = 2;
        // } elseif ($c4isd > 55 && $c4isd <= 75) {
        //     $c4isd = 3;
        // } elseif ($c4isd > 75 && $c4isd <= 90) {
        //     $c4isd = 4;
        // } elseif ($c4isd > 90 && $c4isd <= 100) {
        //     $c4isd = 5;
        // }
        // //NILAI Robotic
        // if ($c5isd <= 35) {
        //     $c5isd = 1;
        // } elseif ($c5isd > 35 && $c5isd <= 65) {
        //     $c5isd = 2;
        // } elseif ($c5isd > 65 && $c5isd <= 80) {
        //     $c5isd = 3;
        // } elseif ($c5isd > 80 && $c5isd <= 90) {
        //     $c5isd = 4;
        // } elseif ($c5isd > 90 && $c5isd <= 100) {
        //     $c5isd = 5;
        // }
        // //NILAI Basis Data
        // if ($c6isd <= 45) {
        //     $c6isd = 1;
        // } elseif ($c6isd > 45 && $c6isd <= 65) {
        //     $c6isd = 2;
        // } elseif ($c6isd > 65 && $c6isd <= 70) {
        //     $c6isd = 3;
        // } elseif ($c6isd > 70 && $c6isd <= 80) {
        //     $c6isd = 4;
        // } elseif ($c6isd > 80 && $c6isd <= 100) {
        //     $c6isd = 5;
        // }

        $data1 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_peminatan' => 1,
            'C1' => $c1sd,
            'C2' => $c2sd,
            'C3' => $c3sd,
            'C4' => $c4sd,
            'C5' => $c5sd,
            'C6' => $c6sd,
        ];
        $data2 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_peminatan' => 2,
            'C1' => $c1ds,
            'C2' => $c2ds,
            'C3' => $c3ds,
            'C4' => $c4ds,
            'C5' => $c5ds,
            'C6' => $c6ds,
        ];
        // $data3 = [
        //     'id_siswa' => $this->input->post('id_siswa'),
        //     'id_peminatan' => 3,
        //     'C1' => $c1isd,
        //     'C2' => $c2isd,
        //     'C3' => $c3isd,
        //     'C4' => $c4isd,
        //     'C5' => $c5isd,
        //     'C6' => $c6isd,
        // ];

        //$this->db->set($data1);
        $this->db->insert('nilai_peminatan', $data1);
        $this->db->insert('nilai_peminatan', $data2);
        // $this->db->insert('nilai_peminatan', $data3);
        $this->db->where('id_peminatan', 0);
        $this->db->delete('nilai_peminatan');
        //$this->db->where('id_siswa', $this->input->post('id_siswa'));
        //$this->db->update('nilai_jurusan');
    }

    // public function c1isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c1isd = $row->C1;
    //     }
    //     return $c1isd;
    // }
    // public function c2isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c2isd = $row->C2;
    //     }
    //     return $c2isd;
    // }
    // public function c3isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c3isd = $row->C3;
    //     }
    //     return $c3isd;
    // }
    // public function c4isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c4isd = $row->C4;
    //     }
    //     return $c4isd;
    // }
    // public function c5isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c5isd = $row->C5;
    //     }
    //     return $c5isd;
    // }
    // public function c6isd()
    // {
    //     $this->db->select('*');
    //     $this->db->from('konversi_nilai');
    //     $this->db->where('id_peminatan', 3);
    //     $data = $this->db->get()->result();
    //     foreach ($data as $row) {
    //         $c6isd = $row->C6;
    //     }
    //     return $c6isd;
    // }

    public function c1ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1ds = $row->C1;
        }
        return $c1ds;
    }
    public function c2ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2ds = $row->C2;
        }
        return $c2ds;
    }
    public function c3ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3ds = $row->C3;
        }
        return $c3ds;
    }
    public function c4ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4ds = $row->C4;
        }
        return $c4ds;
    }
    public function c5ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5ds = $row->C5;
        }
        return $c5ds;
    }
    public function c6ds()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6ds = $row->C6;
        }
        return $c6ds;
    }

    public function c1sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1sd = $row->C1;
        }
        return $c1sd;
    }

    public function c2sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2sd = $row->C2;
        }
        return $c2sd;
    }
    public function c3sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3sd = $row->C3;
        }
        return $c3sd;
    }
    public function c4sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4sd = $row->C4;
        }
        return $c4sd;
    }
    public function c5sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5sd = $row->C5;
        }
        return $c5sd;
    }
    public function c6sd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_peminatan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6sd = $row->C6;
        }
        return $c6sd;
    }

    public function getJoinNilaiPeminatanSiswa()
    {
        $queryNilaiPeminatanSiswa = "SELECT `data_siswa`.`nama_siswa`, `data_siswa`.`no_daftar`, `nilai_peminatan`.* 
        FROM `data_siswa` JOIN `nilai_peminatan` ON `data_siswa`.`id_siswa` = `nilai_peminatan`.`id_siswa` 
        WHERE `data_siswa`.`id_siswa` = `nilai_peminatan`.`id_siswa`
        ";
        return $this->db->query($queryNilaiPeminatanSiswa)->result_array();
    }

    public function getNormalisasi()
    {
        return $this->db->get('normalisasi')->result_array();
    }

    public function inputNormalisasi()
    {
        $c1 = $this->input->post('C1');
        $c2 = $this->input->post('C2');
        $c3 = $this->input->post('C3');
        $c4 = $this->input->post('C4');
        $c5 = $this->input->post('C5');
        $c6 = $this->input->post('C6');

        $data = [
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
        ];

        $this->db->truncate('normalisasi');
        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('normalisasi', $data);
    }

    public function cekKodeSiswa()
    {
        $query = $this->db->query(
            'SELECT MAX(no_daftar) as max_id from data_siswa'
        );
        $rows = $query->row();
        $kode = $rows->max_id;
        $noUrut = (int) substr($kode, 3, 2);
        $noUrut++;
        $char = 'SIS';
        $kode = $char . sprintf('%02s', $noUrut);
        return $kode;
    }
    public function getCetak()
    {
        return $this->db->get('cetak')->result_array();
    }
}
