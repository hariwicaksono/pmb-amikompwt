<?php $this->extend("layouts/appSiswa"); ?>
<?php $this->section("content"); ?>

<h1 class="text-h5 font-weight-bold mb-3">Formulir Pendaftaran Tahun Ajaran <?= $tha_pmb ?></h1>

<div class="mb-4">
    <v-card>
        <v-card-title>
            <v-fab-transition>
                <v-btn color="yellow darken-2" class="grey--text text--darken-4" dark absolute top right fab @click="modalDaftar = true" elevation="2" title="Daftar" v-if="!data_daftar.nodaf">
                    <v-icon large>mdi-plus</v-icon>
                </v-btn>
                <v-btn color="yellow darken-2" class="grey--text text--darken-4" dark absolute top right fab tile @click="editDaftar(data_daftar)" elevation="2" title="Edit" v-else>
                    <v-icon>mdi-file-document-edit</v-icon>
                </v-btn>
            </v-fab-transition>
            Pendaftaran
            <!--<v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" @click="editDaftar(data_daftar)" v-show="data_daftar.nodaf">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>-->
        </v-card-title>
        <v-card-text>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>NODAF</th>
                            <th>Tanggal Daftar</th>
                            <th>Jalur/Gelombang</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{data_daftar.email??"—"}}</td>
                            <td>
                                <span v-if="data_daftar.nodaf">{{ data_daftar.nodaf }}</span>
                                <span v-else>
                                    <v-chip color="error" dark small>
                                        <v-icon left small>mdi-alert</v-icon>Daftar Dahulu
                                    </v-chip>
                                </span>
                            </td>
                            <td>{{ dateYmdHis(data_daftar.tgldaftar)??"—"}}</td>
                            <td>{{ data_daftar.gelombang??"—"}}</td>
                            <td>{{ data_daftar.pilihan1??"—"}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            <?= lang('App.dataDiri') ?>
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tampat/Tgl Lahir</th>
                            <th>Agama</th>
                            <th>Status Pernikahan</th>
                            <th>No HP/WA</th>
                            <th>Alamat Lengkap</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-no-wrap">{{ data_daftar.nama??"—"}}</td>
                            <td>{{ data_daftar.nikktp??"—"}}</td>
                            <td>{{ data_daftar.jk??"—"}}</td>
                            <td>{{ data_daftar.tempatlahir??"—"}}/{{ data_daftar.tgllahir??"—"}}</td>
                            <td>{{ data_daftar.AGAMA??"—"}}</td>
                            <td>{{ data_daftar.status_pernikahan??"—"}}</td>
                            <td>{{ data_daftar.telepon??"—"}}</td>
                            <td class="text-no-wrap">{{ data_daftar.alamat??"—"}}</td>
                            <td class="text-no-wrap">{{ data_daftar.deskripsi_alamat??"—"}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            Data Sekolah
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Sekolah</th>
                            <th>Jurusan</th>
                            <th>RAPOR/NEM/UAN</th>
                            <th>Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-no-wrap">{{ data_daftar.sekolah??"—"}}</td>
                            <td>{{ data_daftar.jurusan??"—"}}</td>
                            <td>{{ data_daftar.nem??"—"}}</td>
                            <td>{{ data_daftar.tahun_lulus??"—"}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            Data Ibu Kandung
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Ibu Kandung</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th>No Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-no-wrap">{{ data_daftar.NAMA_ORTU??"—"}}</td>
                            <td class="text-no-wrap">{{ data_daftar.ALAMATORTU??"—"}}</td>
                            <td>{{ data_daftar.PEKERJAAN_ORTU??"—"}}</td>
                            <td>{{ data_daftar.TELP_ORTU??"—"}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            Data Ayah
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Nama Ayah</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th>No Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-no-wrap">{{ data_daftar.NAMA_AYAH??"—"}}</td>
                            <td class="text-no-wrap">{{ data_daftar.ALAMATORTU??"—"}}</td>
                            <td>{{ data_daftar.PEKERJAAN_AYAH??"—"}}</td>
                            <td>{{ data_daftar.TELP_AYAH??"—"}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<v-btn color="purple" class="white--text" elevation="2" large :disabled="data_daftar.syarat2 == 'Sudah' ? true:false">
    <v-icon>mdi-content-save</v-icon>&nbsp; Simpan &amp; Selesai
</v-btn>

<!-- Modal Save Daftar -->
<template>
    <v-row justify="center">
        <v-dialog v-model="modalDaftar" width="600" persistent>
            <v-card>
                <v-toolbar dark color="purple">
                    <v-toolbar-title><?= lang('App.Pendaftaran') ?></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn icon dark @click="modalDaftar = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-form ref="form" v-model="valid">
                    <v-card-text>
                        <v-container :fluid="true">
                            <v-alert v-if="notifType != ''" dismissible dense outlined :type="notifType">{{notifMessage}}</v-alert>

                            <v-select v-model="select_daftar" :items="list_jenisdaftar" item-text="text" item-value="value" label="Jenis Pendaftaran" :eager="true" :rules="textRules" outlined></v-select>

                            <v-text-field label="<?= lang('App.noKipk') ?> *" v-model="no_kipk" :rules="numberRules" v-if="select_daftar == 'KIP-Kuliah'" outlined></v-text-field>

                            <v-select v-model="select_jenismhs" :items="list_jenismhs" item-text="NAMA" item-value="ID_JENISMHS" label="Jenis Mahasiswa" :loading="loading" :eager="true" :rules="textRules" outlined></v-select>

                            <v-select v-model="select_prodi" :items="list_prodi" item-text="NAMA_DEPT" item-value="KD_DEPT" label="Program Studi" chips multiple :loading="loading" :eager="true" :rules="textRules" outlined></v-select>

                            <input type="hidden" v-model="kelas">

                            <v-text-field label="<?= lang('App.nama') ?> *" v-model="nama" :rules="textRules" outlined>
                            </v-text-field>

                            <v-text-field label="<?= lang('App.email') ?> *" v-model="email" :rules="emailRules" outlined disabled>
                            </v-text-field>
                        </v-container>
                    </v-card-text>
                </v-form>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="purple" dark @click="saveDaftar" :loading="loading">
                        <?= lang('App.save') ?>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template> 
<!-- End Modal Save -->

<template>
    <v-row justify="center">
        <v-dialog v-model="modalEditDaftar" width="600" persistent>
            <v-card>
                <v-toolbar dark color="purple">
                    <v-toolbar-title><?= lang('App.Pendaftaran') ?></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn icon dark @click="editDaftarClose">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-form ref="form" v-model="valid">
                    <v-card-text>
                        <v-container :fluid="true">
                            <v-alert v-if="notifType != ''" dismissible dense outlined :type="notifType">{{notifMessage}}</v-alert>

                            <v-select v-model="select_daftarEdit" :items="list_jenisdaftar" item-text="text" item-value="value" label="Jenis Pendaftaran" :eager="true" outlined></v-select>

                            <v-text-field label="<?= lang('App.noKipk') ?> *" v-model="nokipkEdit" :rules="numberRules" v-if="select_daftarEdit == 'KIP-Kuliah'" outlined></v-text-field>

                            <v-select v-model="select_jenismhsEdit" :items="list_jenismhsEdit" item-text="NAMA" item-value="ID_JENISMHS" label="Jenis Mahasiswa" :loading="loading" :eager="true" outlined></v-select>

                            <v-select v-model="select_prodiEdit" :items="list_prodiEdit" item-text="NAMA_DEPT" item-value="KD_DEPT" label="Program Studi" chips multiple :loading="loading" :eager="true" outlined></v-select>

                            <input type="hidden" v-model="kelasEdit">

                            <v-text-field label="<?= lang('App.nama') ?> *" v-model="namaEdit" :rules="textRules" outlined>
                            </v-text-field>

                            <v-text-field label="<?= lang('App.email') ?> *" v-model="emailEdit" :rules="emailRules" outlined disabled>
                            </v-text-field>
                        </v-container>
                    </v-card-text>
                </v-form>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="purple" dark :loading="loading">
                        <?= lang('App.save') ?>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template> 

<?php $this->endSection("content") ?>

<?php $this->section("js") ?> 
<script>
    computedVue = {
        ...computedVue,

    }
    createdVue = function() {
        this.getDataDaftar();
    }
    var mountedVue = function() {

    }
    var watchVue = {
        select_daftar: function() {
            this.getJenismhs();
            this.select_jenismhs = null;
            this.select_prodi = [];
        },
        select_jenismhs: function() {
            this.getProdi();
            this.select_prodi = [];
            if (this.select_jenismhs == '4') {
                this.kelas = 'Sore';
            } else if (this.select_jenismhs == '3') {
                this.kelas = 'Transfer';
            } else {
                this.kelas = 'Pagi';
            }
        },
        select_prodi: function() {
            if (this.select_prodi.length > 3) {
                this.select_prodi.pop();
                this.snackbar = true;
                this.snackbarType = "error";
                this.snackbarMessage = "you can only select 3";
            }
        },
        select_daftarEdit: function() {
            this.getJenismhsEdit();
        },
        select_jenismhsEdit: function() {
            this.getProdiEdit();
            this.select_prodi = [];
            if (this.select_jenismhsEdit == '4') {
                this.kelasEdit = 'Sore';
            } else if (this.select_jenismhsEdit == '3') {
                this.kelasEdit = 'Transfer';
            } else {
                this.kelasEdit = 'Pagi';
            }
        },
        select_prodiEdit: function() {
            if (this.select_prodiEdit.length > 3) {
                this.select_prodiEdit.pop();
                this.snackbar = true;
                this.snackbarType = "error";
                this.snackbarMessage = "you can only select 3";
            }
        },
    }
    const token = JSON.parse(localStorage.getItem('access_token'));
    const options = {
        headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json"
        }
    }
    dataVue = {
        ...dataVue,
        modalDaftar: false,
        modalEditDaftar: false,
        data_daftar: [],
        gelombang: "<?= $gelombang ?>",
        relasi: 1,
        list_jenisdaftar: [{
                text: 'REGULER',
                value: 'Hanya Daftar'
            },
            {
                text: 'KIP-KULIAH',
                value: 'KIP-Kuliah'
            },
        ],
        list_jenismhs: [],
        list_prodi: [],
        select_daftar: null,
        select_jenismhs: null,
        select_prodi: [],
        kelas: "",
        nama: "<?= session()->get('nama') ?>",
        email: "<?= session()->get('email') ?>",
        no_kipk: "",
        nodaf: "",
        list_jenismhsEdit: [],
        list_prodiEdit: [],
        namaEdit: "",
        emailEdit: "",
        nokipkEdit: "",
        select_daftarEdit: "",
        select_jenismhsEdit: "",
        select_prodiEdit: [],
        kelasEdit: "",
    }
    methodsVue = {
        ...methodsVue,
        modalDaftarOpen: function() {
            this.modalDaftar = true;
            //this.notifType = '';
        },
        modalDaftarClose: function() {
            this.modalDaftar = false;
            //this.select_daftar = null;
            //this.select_jenismhs = null;
            //this.select_prodi = [];
            //this.list_jenismhs = [];
            //this.list_prodi = [];
            //this.$refs.form.resetValidation();
            //this.$refs.form.reset();
        },
        getDataDaftar: function() {
            this.loading = true;
            axios.get(`/api/calonsiswa`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    if (data.status == true) {
                        this.data_daftar = data.data;
                        this.loading = false;
                        this.snackbar = true;
                        this.snackbarType = "success";
                        this.snackbarMessage = data.message;
                    } else {
                        this.loading = false;
                        this.snackbar = true;
                        this.snackbarType = "warning";
                        this.snackbarMessage = data.message;
                    }
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        getJenismhs: function() {
            this.loading = true;
            axios.get(`/api/jenismhs/get?daftar=${this.select_daftar}`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_jenismhs = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        getJenismhsEdit: function() {
            this.loading = true;
            axios.get(`/api/jenismhs/get?daftar=${this.select_daftarEdit}`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_jenismhsEdit = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        getProdi: function() {
            this.loading = true;
            axios.get(`/api/programstudi/get?daftar=${this.select_daftar}&jenis=${this.select_jenismhs}`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_prodi = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        getProdiEdit: function() {
            this.loading = true;
            axios.get(`/api/programstudi/get?daftar=${this.select_daftarEdi}&jenis=${this.select_jenismhsEdit}`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_prodiEdit = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        // Save Daftar
        saveDaftar: function() {
            this.loading = true;
            axios({
                    method: 'post',
                    url: '/api/calonsiswa/save',
                    data: {
                        nama: this.nama,
                        email: this.email,
                        gelombang: this.gelombang,
                        no_kipk: this.no_kipk,
                        pilihan1: this.select_prodi[0]??"",
                        pilihan2: this.select_prodi[1]??"",
                        pilihan3: this.select_prodi[2]??"",
                        status_registrasi: this.select_daftar,
                        kelas: this.kelas,
                        id_relasi: this.relasi,
                        jenis_mhs: this.select_jenismhs,
                        id_jenismhs: this.select_jenismhs,
                    },
                    options
                })
                .then(res => {
                    // handle success
                    this.loading = false
                    var data = res.data;
                    //if (data.expired == true) {
                    //this.snackbar = true;
                    //this.snackbarType = "warning";
                    //this.snackbarMessage = data.message;
                    //setTimeout(() => window.location.href = data.data.url, 1000);
                    //}
                    if (data.status == true) {
                        this.notifType = '';
                        this.snackbar = true;
                        this.snackbarType = "success";
                        this.snackbarMessage = data.message;
                        this.getDataDaftar();
                        this.modalDaftar = false;
                        this.$refs.form.resetValidation();
                    } else {
                        this.notifType = "error";
                        this.notifMessage = data.message;
                        this.snackbar = true;
                        this.snackbarType = "error";
                        this.snackbarMessage = data.message;
                        this.modalDaftar = true;
                        this.$refs.form.validate();
                    }
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                    this.loading = false;
                })
        },
        //Update Daftar
        editDaftar: function(data) {
            this.modalEditDaftar = true;
            this.show = false;
            this.notifType = "";
            this.nodaf = data.nodaf;
            this.select_daftarEdit = data.status_registrasi;
            this.select_jenismhsEdit = data.ID_JENISMHS;
            this.select_prodiEdit = [data.pilihan1, data.pilihan2, data.pilihan3];
            this.namaEdit = data.nama;
            this.emailEdit = data.email;
            this.nokipkEdit = data.no_kipk;
            this.kelasEdit = data.KELAS;
        },
        editDaftarClose: function() {
            this.modalEditDaftar = false;
            this.$refs.form.resetValidation();
        },
        updateDaftar: function() {
            this.loading = true;
            axios.put(`/api/product/update/${this.productIdEdit}`, {
                    product_name: this.productNameEdit,
                    product_price: this.productPriceEdit,
                    product_description: this.productDescriptionEdit,
                    product_image: this.mediaID
                }, options)
                .then(res => {
                    // handle success
                    this.loading = false;
                    var data = res.data;
                    if (data.expired == true) {
                        this.snackbar = true;
                        this.snackbarType = "warning";
                        this.snackbarMessage = data.message;
                        setTimeout(() => window.location.href = data.data.url, 1000);
                    }
                    if (data.status == true) {
                        this.snackbar = true;
                        this.snackbarType = "success";
                        this.snackbarMessage = data.message;
                        this.getProducts();
                        this.modalEdit = false;
                        this.$refs.form.resetValidation();
                    } else {
                        this.notifType = "error";
                        this.notifMessage = data.message;
                        this.modalEdit = true;
                        this.$refs.form.validate();
                    }
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                    this.loading = false
                })
        },
    }
</script>
<?php $this->endSection("js") ?>