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

<v-dialog v-model="dialog" persistent max-width="600px" min-width="600px">
    <div>
        <v-tabs v-model="tab" show-arrows background-color="deep-purple accent-4" icons-and-text dark grow>
            <v-tabs-slider color="purple darken-4"></v-tabs-slider>
            <v-tab v-for="i in tabs" :key="i">
                <v-icon large>{{ i.icon }}</v-icon>
                <div class="subtitle-2 py-1">{{ i.name }}</div>
            </v-tab>
            <v-tab-item>
                <v-card class="px-4">
                    <v-card-text>
                        <v-form ref="loginForm" v-model="valid" lazy-validation>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field v-model="loginEmail" :rules="loginEmailRules" label="E-mail" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="loginPassword" :append-icon="show1?'eye':'eye-off'" :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 8 characters" counter @click:append="show1 = !show1"></v-text-field>
                                </v-col>
                                <v-spacer></v-spacer>
                                <v-col cols="12">
                                    <v-layout>
                                        <a class="subtitle-2" href="<?= base_url('/password/reset') ?>"><?= lang('App.forgotPass') ?></a>
                                        <v-spacer></v-spacer>
                                        <v-btn text large class="mr-2" @click="dialogClose"><?= lang('App.close') ?></v-btn>
                                        <v-btn large color="primary" :loading="loading" @click="submit">Login</v-btn>
                                    </v-layout>
                                </v-col>

                            </v-row>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card class="px-4">
                    <v-card-text>
                        <v-form ref="registerForm" v-model="valid" lazy-validation>
                            <v-row>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field v-model="firstName" :rules="[rules.required]" label="First Name" maxlength="20" required></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="6">
                                    <v-text-field v-model="lastName" :rules="[rules.required]" label="Last Name" maxlength="20" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="password" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 8 characters" counter @click:append="show1 = !show1"></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field block v-model="verify" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, passwordMatch]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Confirm Password" counter @click:append="show1 = !show1"></v-text-field>
                                </v-col>
                                <v-spacer></v-spacer>
                                <v-btn class="mb-1" large block color="purple white--text" @click="validate">Register</v-btn>
                                <v-btn text block class="mr-2" @click="dialogClose"><?= lang('App.close') ?></v-btn>
                            </v-row>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </div>
</v-dialog>

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