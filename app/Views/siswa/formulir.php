<?php $this->extend("layouts/appSiswa"); ?>
<?php $this->section("content"); ?>

<h1 class="text-h4 font-weight-bold mb-3">Formulir Pendaftaran Tahun Ajaran <?= $tha_pmb ?></h1>

<div class="mb-3">
    <v-card>
        <v-card-title>
            Pendaftaran
            <v-spacer></v-spacer>
            <v-btn color="primary" v-if="!daftars.nodaf">
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
                            <td>{{ daftars.email ? daftars.email:'—'}}</td>
                            <td>
                                <span v-if="daftars.nodaf">{{ daftars.nodaf }}</span>
                                <span v-else>
                                    <v-chip color="red" text-color="white" small>
                                        <v-icon left small>mdi-alert</v-icon>Daftar Dahulu
                                    </v-chip>
                                </span>
                            </td>
                            <td>{{ daftars.tgldaftar ? momentDate(daftars.tgldaftar):'—'}}</td>
                            <td>{{ daftars.gelombang ? daftars.gelombang:'—'}}</td>
                            <td>{{ daftars.pilihan1 ? daftars.pilihan1:'—'}}</td>
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
    dataVue = {
        ...dataVue,
        dialog: false,
        show1: false,
        daftars: [],
    }
    methodsVue = {
        ...methodsVue,
        validate() {
            if (this.$refs.loginForm.validate()) {
                // submit form to server/API here...
            }
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.loginForm.resetValidation();
            this.$refs.registerForm.resetValidation();
        },
        dialogClose: function() {
            this.dialog = false;
            this.resetValidation();
        },
        getDataDaftar: function() {
            this.loading = true;
            axios.get(`/api/calonsiswa`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.daftars = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        clear() {
            this.$refs.form.reset()
        },
    }
</script>
<?php $this->endSection("js") ?>