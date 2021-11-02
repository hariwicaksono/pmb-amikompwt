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
            <v-row>
                <v-col>
                    <h4>Nama:</h4>{{data_daftar.nama??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Email:</h4>{{data_daftar.email??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>NODAF:</h4>
                    <span v-if="data_daftar.nodaf">{{ data_daftar.nodaf }}</span>
                    <span v-else>
                        <v-chip color="error" dark small>
                            <v-icon left small>mdi-alert</v-icon>Daftar Dahulu
                        </v-chip>
                    </span>
                </v-col>
                <v-col>
                    <h4>Tanggal Daftar:</h4>{{ dateYmdHis(data_daftar.tgldaftar)??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Jalur/Gelombang:</h4>{{ data_daftar.gelombang??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Jurusan:</h4>{{ data_daftar.pilihan1??"—"}} / {{ data_daftar.pilihan2??"—"}} / {{ data_daftar.pilihan3??"—"}}
                </v-col>
            </v-row>
            <!--<v-simple-table>
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
            </v-simple-table>-->
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            <?= lang('App.dataDiri') ?>
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf" @click="editDatadiri(data_daftar)">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col>
                    <h4>Nama:</h4>{{ data_daftar.nama??"—"}}
                </v-col>
                <v-col>
                    <h4>NIK:</h4>{{ data_daftar.nikktp??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Jenis Kelamin:</h4>{{ data_daftar.jk??"—"}}
                </v-col>
                <v-col>
                    <h4>Tempat/Tgl Lahir:</h4>{{ data_daftar.tempatlahir??"—"}}/{{ data_daftar.tgllahir??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Agama:</h4>{{ data_daftar.AGAMA??"—"}}
                </v-col>
                <v-col>
                    <h4>Status Pernikahan:</h4>{{ data_daftar.status_pernikahan??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>No HP/WA:</h4>{{ data_daftar.telepon??"—"}}
                </v-col>
            </v-row>
            <!--<v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat/Tgl Lahir</th>
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
            </v-simple-table>-->
        </v-card-text>
    </v-card>
</div>

<div class="mb-4">
    <v-card>
        <v-card-title>
            <?= lang('App.dataAlamat') ?>
            <v-spacer></v-spacer>
            <v-btn color="yellow darken-2" class="grey--text text--darken-3" v-show="data_daftar.nodaf" @click="editAlamat(data_daftar)">
                <v-icon>mdi-file-document-edit</v-icon>
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col>
                    <h4>Desa/Kelurahan:</h4>{{ data_daftar.kelurahan??"—"}}
                </v-col>
                <v-col>
                    <h4>RT / RW:</h4>{{ data_daftar.rt??"—"}} / {{ data_daftar.rw??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Kecamatan:</h4>{{ data_daftar.kecamatan??"—"}}
                </v-col>
                <v-col>
                    <h4>Kabupaten:</h4>{{ data_daftar.kabupaten??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Provinsi:</h4>{{ data_daftar.propinsi??"—"}}
                </v-col>
                <v-col>
                    <h4>Kode Pos:</h4>{{ data_daftar.kodepos??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Alamat Lengkap:</h4>{{ data_daftar.alamat??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Deskripsi:</h4>{{ data_daftar.deskripsi_alamat??"—"}}
                </v-col>
            </v-row>
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
            <v-row>
                <v-col>
                    <h4>Sekolah:</h4>{{ data_daftar.sekolah??"—"}}
                </v-col>
                <v-col>
                    <h4>Jurusan:</h4>{{ data_daftar.jurusan??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>RAPOR/NEM/UAN:</h4>{{ data_daftar.nem??"—"}}
                </v-col>
                <v-col>
                    <h4>Tahun Lulus:</h4>{{ data_daftar.tahun_lulus??"—"}}
                </v-col>
            </v-row>
            <!--<v-simple-table>
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
            </v-simple-table>-->
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
            <v-row>
                <v-col>
                    <h4>Ibu Kandung:</h4>{{ data_daftar.NAMA_ORTU??"—"}}
                </v-col>
                <v-col>
                    <h4>Alamat:</h4>{{ data_daftar.ALAMATORTU??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Pekerjaan:</h4>{{ data_daftar.PEKERJAAN_ORTU??"—"}}
                </v-col>
                <v-col>
                    <h4>No Telepon:</h4>{{ data_daftar.TELP_ORTU??"—"}}
                </v-col>
            </v-row>
            <!--<v-simple-table>
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
            </v-simple-table>-->
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
            <v-row>
                <v-col>
                    <h4>Nama Ayah:</h4>{{ data_daftar.NAMA_AYAH??"—"}}
                </v-col>
                <v-col>
                    <h4>Alamat:</h4>{{ data_daftar.ALAMATORTU??"—"}}
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <h4>Pekerjaan:</h4>{{ data_daftar.PEKERJAAN_AYAH??"—"}}
                </v-col>
                <v-col>
                    <h4>No Telepon:</h4>{{ data_daftar.TELP_AYAH??"—"}}
                </v-col>
            </v-row>
            <!--<v-simple-table>
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
            </v-simple-table>-->
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
<!-- End Modal -->

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

<template>
    <v-row justify="center">
        <v-dialog v-model="modalEditDatadiri" width="600" persistent>
            <v-card>
                <v-toolbar dark color="purple">
                    <v-toolbar-title><?= lang('App.Pendaftaran') ?></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn icon dark @click="editDatadiriClose">
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

<template>
    <v-row justify="center">
        <v-dialog v-model="modalEditAlamat" width="600" persistent>
            <v-card>
                <v-toolbar dark color="purple">
                    <v-toolbar-title><?= lang('App.dataAlamat') ?></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn icon dark @click="editAlamatClose">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-form ref="form" v-model="valid">
                    <v-card-text>
                        <v-container :fluid="true">
                            <v-alert v-if="notifType != ''" dismissible dense outlined :type="notifType">{{notifMessage}}</v-alert>

                            <v-textarea label="<?= lang('App.alamat') ?> *" v-model="alamatEdit" :rules="textRules" :rules="[rules.length(220)]" counter outlined></v-textarea>

                            <v-row>
                                <v-col>
                                    <v-text-field label="<?= lang('App.rt') ?> *" v-model="rtEdit" :rules="textRules" outlined></v-text-field>
                                </v-col>
                                <v-col>
                                    <v-text-field label="<?= lang('App.rw') ?> *" v-model="rwEdit" :rules="textRules" outlined></v-text-field>
                                </v-col>
                            </v-row>

                            <v-text-field label="<?= lang('App.kelurahan') ?> *" v-model="kelurahanEdit" :rules="textRules" outlined></v-text-field>

                            <v-text-field label="<?= lang('App.kecamatan') ?> *" v-model="kecamatanEdit" :rules="textRules" outlined></v-text-field>

                            <v-select label="<?= lang('App.pilihProvinsi') ?> *" v-model="select_provinsiEdit" :items="list_provinsi" item-text="provinsi" item-value="id_provinsi" :eager="true" outlined></v-select>

                            <v-select label="<?= lang('App.pilihKabupaten') ?> *" v-model="select_kabupatenEdit" :items="list_kabupaten" item-text="nama_kabupaten" item-value="id_kabupaten" :eager="true" outlined></v-select>

                            <v-text-field label="<?= lang('App.kodepos') ?> *" v-model="kodeposEdit" :rules="textRules" outlined></v-text-field>

                            <v-textarea label="<?= lang('App.deskripsiAlamat') ?> *" v-model="deskalamatEdit" :rules="[rules.length(220)]" counter outlined></v-textarea>

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
    var mountedVue = function() {}
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
        select_provinsiEdit: function() {
            this.getKabupaten();
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
        rules: {
            email: v => !!(v || '').match(/@/) || 'Please enter a valid email',
            length: len => v => (v || '').length <= len || `Invalid character length, required ${len}`,
            password: v => !!(v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
                'Password must contain an upper case letter, a numeric character, and a special character',
            required: v => !!v || 'This field is required',
        },
        modalDaftar: false,
        modalEditDaftar: false,
        modalEditDatadiri: false,
        modalEditAlamat: false,
        modalEditIbu: false,
        modalEditAyah: false,
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
        alamatEdit: "",
        kelurahanEdit: "",
        rtEdit: "",
        rwEdit: "",
        kecamatanEdit: "",
        select_kabupatenEdit: "",
        select_provinsiEdit: "",
        list_kabupaten: [],
        list_provinsi: [],
        kodeposEdit: "",
        deskalamatEdit: "",
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
                        pilihan1: this.select_prodi[0] ?? "",
                        pilihan2: this.select_prodi[1] ?? "",
                        pilihan3: this.select_prodi[2] ?? "",
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
            axios.put(`/api/calonsiswa/update/${this.productIdEdit}`, {
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
        //Update Data Diri
        editDatadiri: function(data) {
            this.modalEditDatadiri = true;
            this.notifType = "";
            this.nodaf = data.nodaf;
            this.namaEdit = data.nama;
            this.nikEdit = data.nikktp;
            this.jenkelEdit = data.jk;
            this.tplahirEdit = data.tempatlahir;
            this.tglahirEdit = data.tgllahir;
            this.agamaEdit = data.AGAMA;
            this.statusEdit = data.status_pernikahan;
            this.teleponEdit = data.telepon;
        },
        editDatadiriClose: function() {
            this.modalEditDatadiri = false;
            this.$refs.form.resetValidation();
        },
        updateDatadiri: function() {
            this.loading = true;
            axios.put(`/api/calonsiswa/update/${this.nodaf}`, {
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
        getProvinsi: function() {
            this.loading = true;
            axios.get(`/api/provinsi`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_provinsi = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        getKabupaten: function() {
            this.loading = true;
            axios.get(`/api/kabupaten/get?provinsi=${this.select_provinsiEdit}`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.list_kabupaten = data.data;
                    this.loading = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        //Update Alamat
        editAlamat: function(data) {
            this.modalEditAlamat = true;
            this.notifType = "";
            this.getProvinsi();
            this.nodaf = data.nodaf;
            this.alamatEdit = data.alamat;
            this.kelurahanEdit = data.kelurahan;
            this.rtEdit = data.rt;
            this.rwEdit = data.rw;
            this.kecamatanEdit = data.kecamatan;
            this.select_kabupatenEdit = data.kabupaten;
            this.select_provinsiEdit = data.propinsi;
            this.kodeposEdit = data.kodepos;
            this.deskalamatEdit = data.deskripsi_alamat;
        },
        editAlamatClose: function() {
            this.modalEditAlamat = false;
            this.$refs.form.resetValidation();
        },
        updateAlamat: function() {
            this.loading = true;
            axios.put(`/api/calonsiswa/update/${this.productIdEdit}`, {
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