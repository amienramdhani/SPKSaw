 <?php
 defined('BASEPATH') or exit('No direct script access allowed');

 class DpSaw extends CI_Controller
 {
     public function __construct()
     {
         parent::__construct();
         $this->load->library('form_validation');
         $this->load->model('DpSaw_model', 'dps');
     }

     public function peminatan()
     {
         $data['judul'] = 'Data peminatan';
         $data['namauser'] = 'Admin SPK';

         $data['user'] = $this->dps->getEmail();
         $data['peminatan'] = $this->dps->getPeminatan();

         $this->form_validation->set_rules(
             'nama_peminatan',
             'Nama Peminatan',
             'required'
         );

         if ($this->form_validation->run() == false) {
             $this->load->view('templates/header', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('templates/topbar', $data);
             $this->load->view('dpSaw/peminatan', $data);
             $this->load->view('templates/footer');
             $this->load->view('templates/footer');
             $this->load->view('dpSaw/modal/modal_input_nilai_peminatan');
         } else {
             $this->dps->tambahPeminatan();
             $this->session->set_flashdata(
                 'message',
                 '<div align="center" class="alert alert-success" role="alert">
                                            Peminatan baru berhasil ditambahkan
                                            </div>'
             );
             redirect('dpSaw/peminatan');
         }
     }

     public function editPeminatan()
     {
         $this->dps->editPeminatan();
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Peminatan berhasil diubah!
                                            </div>'
         );
         redirect('dpSaw/peminatan');
     }

     public function hapusPeminatan($id)
     {
         $this->dps->hapusPeminatan($id);
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Peminatan berhasil dihapus!
                                            </div>'
         );
         redirect('dpSaw/peminatan');
     }

     public function nilaipeminatan()
     {
         $this->dps->inputNilaiPeminatan();
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Nilai Peminatan berhasil ditambah!
                                            </div>'
         );
         redirect('dpSaw/peminatan');
     }

     public function kriteria()
     {
         $data['judul'] = 'Data Kriteria';
         $data['namauser'] = 'Admin SPK';

         $data['user'] = $this->dps->getEmail();
         $data['kriteria'] = $this->dps->getKriteria();
         $data['kode'] = $this->dps->cekKodeKriteria();

         $this->form_validation->set_rules(
             'nama_kriteria',
             'Nama kriteria',
             'required'
         );
         $this->form_validation->set_rules(
             'atribut_kriteria',
             'Atribut kriteria',
             'required'
         );
         $this->form_validation->set_rules(
             'bobot_kriteria',
             'Bobot kriteria',
             'required'
         );

         if ($this->form_validation->run() == false) {
             $this->load->view('templates/header', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('templates/topbar', $data);
             $this->load->view('dpSaw/kriteria', $data);
             $this->load->view('templates/footer');
         } else {
             $this->dps->tambahKriteria();
             $this->session->set_flashdata(
                 'message',
                 '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria baru berhasil ditambahkan
                                            </div>'
             );
             redirect('dpSaw/kriteria');
         }
     }

     public function editKriteria()
     {
         $this->dps->editKriteria();
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria berhasil diubah!
                                            </div>'
         );
         redirect('dpSaw/kriteria');
     }

     public function hapusKriteria($id)
     {
         $this->dps->hapusKriteria($id);
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria berhasil dihapus!
                                            </div>'
         );
         redirect('dpSaw/kriteria');
     }

     public function nilai()
     {
         $data['judul'] = 'Data Nilai Mahasiswa';
         $data['namauser'] = 'Admin SPK';

         $data['user'] = $this->dps->getEmail();
         $data['nilai'] = $this->dps->getNilai();

         if ($this->form_validation->run() == false) {
             $this->load->view('templates/header', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('templates/topbar', $data);
             $this->load->view('dpSaw/nilai', $data);
             $this->load->view('templates/footer');
             $this->load->view('templates/footer');
         }
     }
     public function hapusNilai($id)
     {
         $this->dps->hapusNilai($id);
         $this->session->set_flashdata(
             'message',
             '<div align="center" class="alert alert-success" role="alert">
                                            Nilai berhasil dihapus!
                                            </div>'
         );
         redirect('dpSaw/nilai');
     }
 }

