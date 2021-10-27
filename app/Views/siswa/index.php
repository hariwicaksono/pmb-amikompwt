<?php $this->extend("layouts/appSiswa"); ?>
<?php $this->section("content"); ?>

<div class="mb-3">
    <v-card v-if="show == true">
        <v-skeleton-loader type="image"></v-skeleton-loader>
    </v-card>
    <v-card v-if="show == false">
        <v-img class="deep-purple white--text align-end" height="150px">
            <v-card-title class="text-h5"><?= session()->get('nama') ?></v-card-title>
            <v-card-subtitle class="mb-3"><?= session()->get('email') ?></v-card-subtitle>
        </v-img>
    </v-card>
</div>

<v-container>
    <div class="mt-n10 mb-10">
        <v-card>
            <v-card-text>
                <div class="d-flex flex-no-wrap justify-space-between">
                    <v-progress-circular :rotate="-90" :size="100" :width="15" :value="20" color="red">
                        20%
                    </v-progress-circular>
                    <div>
                        <v-card-title class="text-subtitle-2 mb-0">Data Diri</v-card-title>
                        <v-card-subtitle>Lengkapi data siswa</v-card-subtitle>
                    </div>
                    <v-card-actions>
                        <v-btn color="orange darken-2" fab dark x-small rounded depressed>
                            <v-icon>
                                mdi-chevron-right
                            </v-icon>
                        </v-btn>
                    </v-card-actions>
                </div>
            </v-card-text>
        </v-card>
    </div>

    <div class="mb-10">
        <v-row justify="space-around">
            <v-btn icon v-for="(item, i) in menuItems" :key="i" :href="item.link" :title="item.title" :alt="item.title">
                <v-icon large :color="item.color">
                    {{item.icon}}
                </v-icon>
            </v-btn>

        </v-row>
    </div>

    <div class="pa-10 mb-3">
        <v-img class="mx-auto" width="300px" src="<?= base_url('assets/images/notfound.png') ?>">
        </v-img>
    </div>

    <div>
        <v-row>

        </v-row>
    </div>

</v-container>

<?php $this->endSection("content") ?>

<?php $this->section("js") ?> 
<script>
    let startCount = 0;

    computedVue = {
        ...computedVue,

    }
    createdVue = function() {
        
    }
    var mountedVue = function() {
        
    }
    dataVue = {
        ...dataVue,
        cardFakultas: [{
                name: "Ilmu Komputer",
                img: "http://pmb.amikompurwokerto.ac.id/assets/main/images/iconpack/web-development_2210153.png",
                link: "http://fik.amikompurwokerto.ac.id",
            },
            {
                name: "Bisnis & Ilmu Sosial",
                img: "http://pmb.amikompurwokerto.ac.id/assets/main/images/iconpack/diagram_2210211.png",
                link: "http://fbis.amikompurwokerto.ac.id",
            }
        ],
        menuItems: [{
                title: 'Formulir',
                icon: 'mdi-form-select',
                color: 'primary',
                link: '/calonsiswa/formulir',
            },
            {
                title: 'Bukti Pendaftaran',
                icon: 'mdi-receipt',
                color: 'purple darken-2',
                link: '/page/Jalur_penerimaan',
            },
            {
                title: 'Foto',
                icon: 'mdi-folder-image',
                color: 'orange darken-2',
                link: '/calonsiswa/upload',
            },
            {
                title: 'Fasilitas',
                icon: 'mdi-flag',
                color: 'green darken-2',
                link: '/page/fasilitas',
            },
        ],
    }
    methodsVue = {
        ...methodsVue,

    }
</script>
<?php $this->endSection("js") ?>