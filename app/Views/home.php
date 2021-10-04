<?php $this->extend("layouts/appFront"); ?>
<?php $this->section("content"); ?>

<template>
    <v-carousel class="purple" height="auto" cycle hide-delimiter-background>
        <v-carousel-item v-for="item in slideshows" :key="item.id_slideshow">
            <v-img :src="'https://pmb.amikompurwokerto.ac.id/files/2021/' + item.img_slideshow" :lazy-src="'https://pmb.amikompurwokerto.ac.id/files/2021/' + item.img_slideshow" class="grey lighten-2" width="100%">
                <template v-slot:placeholder>
                    <v-row class="fill-height ma-0" align="center" justify="center">
                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                    </v-row>
                </template>
            </v-img>
        </v-carousel-item>
    </v-carousel>
</template>

<v-dialog v-model="dialog" persistent max-width="600px" min-width="600px">
    <div>
        <v-tabs v-model="tab" show-arrows background-color="deep-purple accent-4" icons-and-text dark grow>
            <v-tabs-slider color="purple darken-4"></v-tabs-slider>
            <v-tab v-for="i in tabs" :key="i">
                <v-icon large>{{ i.icon }}</v-icon>
                <div class="caption py-1">{{ i.name }}</div>
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
                                        <a class="subtitle-1" href="<?= base_url('/password/reset') ?>"><?= lang('App.forgotPass') ?></a>
                                        <v-spacer></v-spacer>
                                        <v-btn text large class="mr-2" @click="dialog = false"><?= lang('App.close') ?></v-btn>
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
                                <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                                    <v-btn x-large block :disabled="!valid" color="success" @click="validate">Register</v-btn>
                                </v-col>
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
    computedVue = {
        ...computedVue,
        passwordMatch() {
            return () => this.password === this.verify || "Password must match";
        }
    }
    createdVue = function() {
        this.getSlides();
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
            this.$refs.form.resetValidation();
        },
        getSlides: function() {
            this.show = true;
            axios.get(`/api/slideshow`)
                .then(res => {
                    // handle success
                    var data = res.data;
                    this.slideshows = data.data;
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
        }
    }
</script>

<?php $this->endSection("js") ?>