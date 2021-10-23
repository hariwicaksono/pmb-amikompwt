<?php $this->extend("layouts/appSiswa"); ?>
<?php $this->section("content"); ?>

<h1 class="text-h4 font-weight-bold mb-3">Formulir Pendaftaran Tahun Ajaran <?= $tha_pmb ?></h1>

<div class="mb-3">
    <v-card>
        <v-card-title>
            Pendaftaran
            <v-spacer></v-spacer>
            <v-btn color="primary" v-if="!data_daftar.nodaf" @click="dialogOpen">
                <v-icon>mdi-file-document-edit</v-icon>&nbsp; Daftar
            </v-btn>
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
                            <td>{{ data_daftar.email ? data_daftar.email:'—'}}</td>
                            <td>
                                <span v-if="data_daftar.nodaf">{{ data_daftar.nodaf }}</span>
                                <span v-else>
                                    <v-chip color="red" text-color="white" small>
                                        <v-icon left small>mdi-alert</v-icon>Daftar Dahulu
                                    </v-chip>
                                </span>
                            </td>
                            <td>{{ data_daftar.tgldaftar ? momentDate(data_daftar.tgldaftar):'—'}}</td>
                            <td>{{ data_daftar.gelombang ? data_daftar.gelombang:'—'}}</td>
                            <td>{{ data_daftar.pilihan1 ? data_daftar.pilihan1:'—'}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card-text>
    </v-card>
</div>

<div class="mb-3">
    <v-card>
        <v-card-title>
            <?= lang('App.dataDiri') ?>
            <v-spacer></v-spacer>
            <v-btn color="orange">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>

        </v-card-text>
    </v-card>
</div>

<div class="mb-3">
    <v-card>
        <v-card-title>
            Data Sekolah
            <v-spacer></v-spacer>
            <v-btn color="orange">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>

        </v-card-text>
    </v-card>
</div>

<div class="mb-3">
    <v-card>
        <v-card-title>
            Data Ibu Kandung
            <v-spacer></v-spacer>
            <v-btn color="orange">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>

        </v-card-text>
    </v-card>
</div>

<div class="mb-3">
    <v-card>
        <v-card-title>
            Data Ayah
            <v-spacer></v-spacer>
            <v-btn color="orange">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>

        </v-card-text>
    </v-card>
</div>

<!-- Modal Save -->
<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" width="600" persistent>
            <v-card>
                <v-toolbar dark color="purple">
                    <v-toolbar-title><?= lang('App.Pendaftaran') ?></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn icon dark @click="dialogClose">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-form ref="form" v-model="valid">
                    <v-card-text>
                        <v-container :fluid="true">
                            <v-alert v-if="notifType != ''" dismissible dense outlined :type="notifType">{{notifMessage}}</v-alert>
                            <v-select v-model="select_daftar" :items="list_jenisdaftar" item-text="text" item-value="value" label="Jenis Pendaftaran" @change="loadJenismhs" :eager="true" outlined></v-select>

                            <v-select v-model="select_jenismhs" :items="list_jenismhs" item-text="NAMA" item-value="ID_JENISMHS" label="Jenis Mahasiswa" @change="loadProdi" :loading="loading" :eager="true" outlined></v-select>

                            <v-select :items="list_prodi" item-text="NAMA_DEPT" item-value="KD_DEPT" label="Program Studi" v-on:input="limiter" chips multiple :loading="loading" :eager="true" outlined></v-select>

                            <v-text-field label="<?= lang('App.nama') ?> *" v-model="nama" :rules="textRules" outlined>
                            </v-text-field>

                            <v-text-field label="<?= lang('App.email') ?> *" v-model="email" :rules="emailRules" outlined>
                            </v-text-field>
                        </v-container>
                    </v-card-text>
                </v-form>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="purple" text @click="saveDaftar" :loading="loading">
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>     
<!-- End Modal Save Product -->

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
    var watchVue = {}
    dataVue = {
        ...dataVue,
        dialog: false,
        show1: false,
        data_daftar: [],
        select_daftar: null,
        select_jenismhs: null,
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
        nama: "",
        email: "",
        gelombang: "<?= $gelombang ?>",
    }
    methodsVue = {
        ...methodsVue,
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
        loadJenismhs() {
            this.getJenismhs();
        },
        loadProdi() {
            this.getProdi();
        },
        limiter(e) {
            if (e.length > 3) {
                console.log('you can only select 3', e)
                e.pop()
                this.snackbar = true;
                this.snackbarType = "error";
                this.snackbarMessage = "you can only select 3";
            }
        },
        dialogOpen: function() {
            this.dialog = true;
            this.notifType = '';
            this.textRules = [
                v => !!v || '<?= lang("App.isRequired") ?>',
            ];
            this.emailRules = [
                v => !!v || '<?= lang("App.emailRequired") ?>',
                v => /.+@.+/.test(v) || '<?= lang("App.emailValid") ?>',
            ];
        },
        dialogClose: function() {
            this.dialog = false;
            this.select_daftar= null,
            this.select_jenismhs= null,
            this.list_jenismhs = [],
            this.list_prodi = [],
            this.resetValidation();
            this.reset();
        },
        getDataDaftar: function() {
            this.loading = true;
            axios.get(`/api/calonsiswa`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.data_daftar = data.data;
                    this.loading = false;
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
        // Save Daftar
        saveDaftar: function() {
            this.loading = true;
            axios({
                    method: 'post',
                    url: '/api/calonsiswa/save',
                    data: {
                        nama: this.nama,
                        email: this.email,
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
                        this.snackbar = true;
                        this.snackbarType = "success";
                        this.snackbarMessage = data.message;
                        this.getDataDaftar();
                        this.nama = '';
                        this.email = '';
                        this.modalAdd = false;
                        this.$refs.form.resetValidation();
                    } else {
                        this.notifType = "error";
                        this.notifMessage = data.message;
                        this.modalAdd = true;
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