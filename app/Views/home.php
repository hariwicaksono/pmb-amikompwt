<?php $this->extend("layouts/appFront"); ?>
<?php $this->section("content"); ?>

<div class="mb-3">
    <v-card>
        <div v-if="show == true">
            <v-skeleton-loader type="image, image"></v-skeleton-loader>
        </div>
        <div v-if="show == false">
            <v-carousel height="auto" cycle hide-delimiter-background>
                <v-carousel-item v-for="item in slideshows" :key="item.id_slideshow" :src="'https://pmb.amikompurwokerto.ac.id/files/2021/' + item.img_slideshow" class="deep-purple fill-height">
                </v-carousel-item>
            </v-carousel>
        </div>
    </v-card>
</div>

<div>
    <v-row>
        <v-col v-for="(item, i) in cardFakultas" :key="i" link :href="item.link" cols="12" sm="6">
            <v-card>
                <div class="d-flex flex-no-wrap justify-space-between">
                    <div>
                        <v-card-title class="text-h5"><strong>Fakultas</strong>{{item.name}}</v-card-title>
                        <v-card-actions>
                            <v-btn :href="item.link" class="ml-2 mt-5" outlined rounded>
                                Selengkapnya
                            </v-btn>
                        </v-card-actions>
                    </div>
                    <v-avatar class="ma-3" size="125" tile>
                        <v-img :src="item.img"></v-img>
                    </v-avatar>
                </div>
            </v-card>
        </v-col>
    </v-row>
</div>

<div>
    <v-row>
        <v-col class="text-center" cols="12" sm="3">
            <v-card>
                <h1 class="text-h4 pt-3">{{ intJumlahAkun }}</h1>
                <v-card-text>Daftar Akun Online</v-card-text>
            </v-card>
        </v-col>
        <v-col class="text-center" cols="12" sm="3">
            <v-card>
                <h1 class="text-h4 pt-3">{{ intJumlahCalonsiswa }}</h1>
                <v-card-text>Total Formulir Masuk</v-card-text>
            </v-card>
        </v-col>
        <v-col class="text-center" cols="12" sm="3">
            <v-card>
                <h1 class="text-h4 pt-3">{{ intJumlahTahunlalu }}</h1>
                <v-card-text>Pendaftar Tahun Lalu</v-card-text>
            </v-card>
        </v-col>
        <v-col class="text-center" cols="12" sm="3">
            <v-card>
                <h1 class="text-h4 pt-3">{{ intJumlahBeasiswa }}</h1>
                <v-card-text>Lulus Beasiswa</v-card-text>
            </v-card>
        </v-col>
    </v-row>
</div>

<?php $this->endSection("content") ?>

<?php $this->section("js") ?> 
<script>
    let startCount = 0;

    computedVue = {
        ...computedVue,
        passwordMatch() {
            return () => this.password === this.verify || "Password must match";
        },
        intJumlahAkun() {
            return Math.trunc(this.count1).toLocaleString()
        },
        intJumlahCalonsiswa() {
            return Math.trunc(this.count2).toLocaleString()
        },
        intJumlahTahunlalu() {
            return Math.trunc(this.count3).toLocaleString()
        },
        intJumlahBeasiswa() {
            return Math.trunc(this.count4).toLocaleString()
        }
    }
    createdVue = function() {
        this.getSlides();
    }
    var mountedVue = function() {
        this.counterJumlah();
    }
    dataVue = {
        ...dataVue,
        slideshows: [],
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
        count1: startCount,
        count2: startCount,
        count3: startCount,
        count4: startCount,
        jumlahAkun: <?= $jumlah_akun ?>,
        jumlahCalonsiswa: <?= $jumlah_calonsiswa ?>,
        jumlahTahunlalu: <?= $jumlah_tahunlalu ?>,
        jumlahBeasiswa: <?= $jumlah_beasiswa ?>,
    }
    methodsVue = {
        ...methodsVue,
        getSlides: function() {
            this.show = true;
            axios.get(`/openapi/slideshow`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.slideshows = data.data;
                    this.show = false;
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                })
        },
        counterJumlah() {
            anime({
                targets: this.$data,
                count1: this.jumlahAkun,
                count2: this.jumlahCalonsiswa,
                count3: this.jumlahTahunlalu,
                count4: this.jumlahBeasiswa,
                duration: 10000,
                delay: 200,
                easing: 'easeInOutCubic',
            })
        },
    }
</script>
<?php $this->endSection("js") ?>