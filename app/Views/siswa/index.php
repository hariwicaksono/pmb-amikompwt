<?php $this->extend("layouts/appSiswa"); ?>
<?php $this->section("content"); ?>

<div class="mb-3">
    <v-card v-if="show == true">
        <v-skeleton-loader type="image"></v-skeleton-loader>
    </v-card>
    <v-card v-if="show == false">
        <v-card>
            <v-img class="deep-purple white--text align-end" height="150px">
                <v-card-title class="text-h5">Agus Harimurti</v-card-title>
                <v-card-subtitle class="mb-3">email@gmail.com</v-card-subtitle>
            </v-img>
        </v-card>
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
        dialog: false,
        tab: 0,
        tabs: [{
                name: "Login",
                icon: "mdi-account"
            },
            {
                name: "Register",
                icon: "mdi-account-outline"
            }
        ],
        valid: true,
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        verify: "",
        loginPassword: "",
        loginEmail: "",
        loginEmailRules: [
            v => !!v || "Required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],
        emailRules: [
            v => !!v || "Required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],

        show1: false,
        rules: {
            required: value => !!value || "Required.",
            min: v => (v && v.length >= 8) || "Min 8 characters"
        },
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
        getSlides: function() {
            this.show = true;
            axios.get(`/api/slideshow`)
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
        submit() {
            this.loading = true;
            axios({
                    method: 'post',
                    url: '/api/auth/login',
                    data: {
                        email: this.email,
                        password: this.password,
                    },
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(res => {
                    // handle success
                    this.loading = false
                    var data = res.data;
                    if (data.status == true) {
                        localStorage.setItem('access_token', JSON.stringify(data.access_token));
                        this.snackbar = true;
                        this.snackbarType = "success";
                        this.snackbarMessage = data.message;
                        this.$refs.form.resetValidation();
                        setTimeout(() => window.location.reload(), 1000);
                    } else {
                        this.notifType = "error";
                        this.notifMessage = data.message;
                        this.snackbar = true;
                        this.snackbarType = "warning";
                        this.snackbarMessage = data.message.email || data.message.password;
                        this.$refs.form.validate();
                    }
                })
                .catch(err => {
                    // handle error
                    console.log(err.response);
                    this.loading = false
                })
        },
        clear() {
            this.$refs.form.reset()
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