<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DpSaw_model extends CI_Model
{
    public function getEmail()
    {
        return $this->db
            ->get_where('user', ['email' => $this->session->userdata('email')])
            ->row_array();
    }

    public function getPeminatan()
    {
        return $this->db->get('peminatan')->result_array();
    }

    public function getKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }
    public function getNilai()
    {
        return $this->db->get('nilai')->result_array();
    }

    public function hapusNilai($id)
    {
        $this->db->where('id_nilai', $id);
        $this->db->delete('nilai');
    }

    public function tambahPeminatan()
    {
        $data = [
            'nama_peminatan' => $this->input->post('nama_peminatan', true),
        ];
        $this->db->insert('peminatan', $data);
    }

    public function editPeminatan()
    {
        $nama_peminatan = $this->input->post('nama_peminatan');

        $data = [
            'nama_peminatan' => $nama_peminatan,
        ];

        $this->db->where('id_peminatan', $this->input->post('id_peminatan'));
        $this->db->update('peminatan', $data);
    }

    public function hapusPeminatan($id)
    {
        $this->db->where('id_peminatan', $id);
        $this->db->delete('peminatan');
    }

    public function tambahKriteria()
    {
        $kode = $this->cekKodeKriteria();
        $data = [
            'kode_kriteria' => $kode,
            'nama_kriteria' => $this->input->post('nama_kriteria', true),
            'atribut_kriteria' => $this->input->post('atribut_kriteria', true),
            'bobot_kriteria' => $this->input->post('bobot_kriteria', true),
        ];
        $this->db->insert('kriteria', $data);
    }

    public function editKriteria()
    {
        $kode = $this->input->post('kode_kriteria');
        $nama_kriteria = $this->input->post('nama_kriteria');
        $atribut_kriteria = $this->input->post('atribut_kriteria');
        $bobot_kriteria = $this->input->post('bobot_kriteria');

        $data = [
            'kode_kriteria' => $kode,
            'nama_kriteria' => $nama_kriteria,
            'atribut_kriteria' => $atribut_kriteria,
            'bobot_kriteria' => $bobot_kriteria,
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kriteria', $data);
    }

    public function hapusKriteria($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kriteria');
    }

    public function cekKodeKriteria()
    {
        $query = $this->db->query(
            'SELECT MAX(kode_kriteria) as max_id from kriteria'
        );
        $rows = $query->row();
        $kode = $rows->max_id;
        $noUurut = (int) substr($kode, 2, 1);
        $noUurut++;
        $char = 'C';
        $kode = $char . sprintf('%02s', $noUurut);
        return $kode;
    }

    public function inputNilaiPeminatan()
    {
        $c1 = $this->input->post('c1');
        $c2 = $this->input->post('c2');
        $c3 = $this->input->post('c3');
        $c4 = $this->input->post('c4');
        $c5 = $this->input->post('c5');
        $c6 = $this->input->post('c6');
        $c7 = $this->input->post('c7');
        $c8 = $this->input->post('c8');

        $data = [
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
            'C7' => $c7,
            'C8' => $c8,
        ];

        $this->db->where('id_peminatan', $this->input->post('id_peminatan'));
        $this->db->update('peminatan', $data);
    }
}
