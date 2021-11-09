<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" rel="stylesheet"> 
    <link href="<?= base_url('assets/css/vuetify.min.css') ?>" rel="stylesheet">  
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>

<body>
    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-logo"><img src="<?= base_url('assets/images/Logo.png') ?>" alt="Preloader" width="64"></div>
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    <div id="app">
        <v-app>
            <v-app-bar app color="purple darken-3" class="gde-purple-1" dark elevate-on-scroll>
                <v-app-bar-nav-icon color="yellow darken-2" x-large @click.stop="sidebarMenu = !sidebarMenu"></v-app-bar-nav-icon>
                <v-btn href="<?= base_url() ?>" text>
                    <v-toolbar-title style="cursor: pointer">AMIKOM</v-toolbar-title>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn text color="yellow darken-2" x-large class="d-none d-lg-block" @click="modalAuthOpen">
                    <v-icon>mdi-login-variant</v-icon> &nbsp;Login
                </v-btn>

                <v-btn icon color="yellow darken-3" x-large class="d-block d-lg-none" @click="modalAuthOpen">
                    <v-icon>mdi-login-variant</v-icon>
                </v-btn>

                <?php if (!empty(session()->get('username'))) : ?>
                    <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon v-bind="attrs" v-on="on">
                                <v-icon>mdi-account-circle</v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-subheader>Profile</v-subheader>
                            <v-list-item>Halo, <?= session()->get('username') ?></v-list-item>
                            <v-list-item link href="/logout" @click="localStorage.removeItem('access_token')">
                                <v-list-item-icon>
                                    <v-icon>mdi-logout</v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title>Logout</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                <?php endif; ?>
                <v-btn icon @click.stop="rightMenu = !rightMenu">
                    <v-icon>mdi-cog-outline</v-icon>
                </v-btn>
            </v-app-bar>

            <v-navigation-drawer class="gdb-purple-1 yellow--text text--darken-2" v-model="sidebarMenu" app floating :permanent="sidebarMenu" :mini-variant.sync="mini" v-if="!isMobile">
                <v-list dense elevation="2">
                    <v-list-item>
                        <v-list-item-action>
                            <v-icon color="yellow darken-2" @click.stop="toggleMini = !toggleMini">mdi-chevron-left</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>

                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <v-list-item class="px-2">
                    <v-list-item-avatar>
                        <v-avatar color="yellow darken-3" size="36">
                            <span class="white--text text-h6"><?= substr(session()->get('username'), 0, 1); ?></span>
                        </v-avatar>
                    </v-list-item-avatar>
                    <v-list-item-content class="text-truncate">
                        <?= session()->get('username') ?>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list>
                    <v-list-item class="px-2" v-for="(item, i) in navdrawerItems" :key="i" link :href="item.link">
                        <v-list-item-icon>
                            <v-icon v-text="item.icon" color="yellow darken-2" large></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text" class="yellow--text text-darken-2"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <?php //if (session()->get('role') == 1) : 
                    ?>

                    <?php //endif; 
                    ?>

                    <?php //if (session()->get('role') == 2) : 
                    ?>

                    <?php //endif; 
                    ?>

                </v-list>
            </v-navigation-drawer>

            <v-navigation-drawer v-model="rightMenu" app right temporary bottom>
                <template v-slot:prepend>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>Pengaturan</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>

                <v-divider></v-divider>

                <v-list-item>
                    <v-list-item-avatar>
                        <v-icon>mdi-theme-light-dark</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        Tema {{themeText}}
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-switch v-model="dark" inset @click="toggleTheme"></v-switch>
                    </v-list-item-action>
                </v-list-item>

            </v-navigation-drawer>

            <v-main>
                <v-container>
                    <?= $this->renderSection('content') ?>
                </v-container>
            </v-main>

            <p class="mx-auto">
                &copy; {{ new Date().getFullYear() }} — <strong>amikom</strong>
            </p>

            <v-dialog v-model="modalAuth" persistent max-width="600px" min-width="600px" scrollable>
                <v-tabs v-model="tab" show-arrows background-color="deep-purple accent-4" icons-and-text dark grow>
                    <v-tabs-slider color="purple darken-4"></v-tabs-slider>
                    <v-tab v-for="(item, i) in tabs" :key="i">
                        <v-icon large>{{ item.icon }}</v-icon>
                        <div class="subtitle-2 py-1">{{ item.name }}</div>
                    </v-tab>
                    <v-tab-item>
                        <v-card class="px-4">
                            <v-card-text>
                                <v-form ref="formLogin" v-model="valid">
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="loginEmail" :rules="[rules.email]" label="E-mail"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="loginPassword" :append-icon="show?'mdi-eye':'mdi-eye-off'" :rules="[rules.required, rules.min]" :type="show ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 8 characters" counter @click:append="show = !show"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-layout>
                                                <a class="subtitle-2" href="<?= base_url('/password/reset') ?>"><?= lang('App.forgotPass') ?></a>
                                            </v-layout>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn text class="mr-2" @click="modalAuthClose"><?= lang('App.close') ?></v-btn>
                                <v-btn color="purple" large dark :loading="loading" @click="submitLogin">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card class="px-4">
                            <v-card-text>
                                <v-form ref="registerForm" v-model="valid">
                                    <v-row>
                                        <v-col cols="12" sm="6" md="6" class="pb-0">
                                            <v-text-field v-model="firstName" :rules="[rules.required]" label="First Name" maxlength="20" required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6" class="pb-0">
                                            <v-text-field v-model="lastName" :rules="[rules.required]" label="Last Name" maxlength="20" required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="pb-0">
                                            <v-text-field v-model="email" :rules="[rules.email]" label="E-mail" required></v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="pb-0">
                                            <v-text-field v-model="password" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 8 characters" counter @click:append="show1 = !show1"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field block v-model="verify" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, passwordMatch]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Confirm Password" counter @click:append="show1 = !show1"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn text class="mr-2" @click="modalAuthClose"><?= lang('App.close') ?></v-btn>
                                <v-btn large color="purple white--text"><?= lang('App.register') ?></v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
            </v-dialog>

            <v-snackbar v-model="snackbar" :color="snackbarType" :timeout="timeout" text>
                <span v-if="snackbar">{{snackbarMessage}}</span>
                <template v-slot:action="{ attrs }">
                    <v-btn text v-bind="attrs" @click="snackbar = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </template>
            </v-snackbar>   
        </v-app>
    </div>

    <script src="<?= base_url('assets/js/vue.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/vuetify.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/vuetify-image-input.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/axios.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/vuejs-paginate.min.js') ?>" type="text/javascript"></script>
    <script src="https://unpkg.com/animejs@2.2.0/anime.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/main.js') ?>" type="text/javascript"></script>

    <script>
        var computedVue = {
            mini: {
                get() {
                    return this.$vuetify.breakpoint.smAndDown || !this.toggleMini;
                },
                set(value) {
                    this.toggleMini = value;
                }
            },
            isMobile() {
                if (this.$vuetify.breakpoint.smAndDown) {
                    return this.sidebarMenu = false
                }
            },
            themeText() {
                return this.$vuetify.theme.dark ? '<?= lang('App.dark') ?>' : '<?= lang('App.light') ?>'
            }
        }
        var createdVue = function() {
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        }
        var mountedVue = function() {
            const theme = localStorage.getItem("dark_theme");
            if (theme) {
                if (theme === "true") {
                    this.$vuetify.theme.dark = true;
                    this.dark = true;
                } else {
                    this.$vuetify.theme.dark = false;
                    this.dark = false;
                }
            } else if (
                window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                this.$vuetify.theme.dark = false;
                localStorage.setItem(
                    "dark_theme",
                    this.$vuetify.theme.dark.toString()
                );
            }
        }
        var watchVue = {}
        var dataVue = {
            sidebarMenu: true,
            rightMenu: false,
            toggleMini: false,
            dark: false,
            loading: false,
            modalAuth: false,
            valid: true,
            textRules: [],
            emailRules: [],
            notifMessage: '',
            notifType: '',
            snackbar: false,
            timeout: 5000,
            snackbarType: '',
            snackbarMessage: '',
            show: false,
            show1: false,
            navbarItems: [{
                    text: 'Real-Time',
                    icon: 'mdi-clock'
                },
                {
                    text: 'Audience',
                    icon: 'mdi-account'
                },
                {
                    text: 'Conversions',
                    icon: 'mdi-flag'
                },
            ],
            navdrawerItems: [{
                    text: 'Petunjuk',
                    icon: 'mdi-lightbulb-on',
                    link: '/page/petunjuk',
                },
                {
                    text: 'Beasiswa',
                    icon: 'mdi-wallet',
                    link: '/page/Beasiswa',
                },
                {
                    text: 'Jalur Penerimaan',
                    icon: 'mdi-flag',
                    link: '/page/Jalur_penerimaan',
                },
                {
                    text: 'Fasilitas',
                    icon: 'mdi-flag',
                    link: '/page/fasilitas',
                },
                {
                    text: 'Fakultas & Prodi',
                    icon: 'mdi-home-city',
                    link: '/page/fakultas_programstudi',
                },
                {
                    text: 'Download Brosur',
                    icon: 'mdi-file-link',
                    link: 'https://bit.ly/brosuramikompwt21',
                },
                {
                    text: 'Facebook',
                    icon: 'mdi-facebook',
                    link: 'https://www.facebook.com/univamikompurwokerto',
                },
                {
                    text: 'Instagram',
                    icon: 'mdi-instagram',
                    link: 'https://www.instagram.com/amikom_purwokerto/?hl=id',
                },
            ],
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
            firstName: "",
            lastName: "",
            email: "",
            password: "",
            verify: "",
            loginEmail: "",
            loginPassword: "",
            rules: {
                email: v => !!(v || '').match(/@/) || '<?= lang('App.emailValid'); ?>',
                length: len => v => (v || '').length <= len || `<?= lang('App.invalidLength'); ?> ${len}`,
                password: v => !!(v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
                    '<?= lang('App.strongPassword'); ?>',
                min: v => v.length >= 8 || '<?= lang('App.minChar'); ?>',
                required: v => !!v || '<?= lang('App.isRequired'); ?>',
                number: v => Number.isInteger(Number(v)) || "<?= lang('App.isNumber'); ?>",
                zero: v => v > 0 || "<?= lang('App.isZero'); ?>"
            },
        }
        var methodsVue = {
            toggleTheme() {
                this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
                localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString());
            },
            modalAuthOpen: function() {
                this.modalAuth = true;
            },
            modalAuthClose: function() {
                this.modalAuth = false;
                this.loginEmail = "";
                this.loginPassword = "";
                this.$refs.formLogin.resetValidation();
            },
            submitLogin() {
                this.loading = true;
                axios.post('/openapi/auth/login', {
                        email: this.loginEmail,
                        password: this.loginPassword,
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
                            this.modalAuth = false;
                            this.$refs.formLogin.resetValidation();
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            this.notifType = "error";
                            this.notifMessage = data.message;
                            this.snackbar = true;
                            this.snackbarType = "warning";
                            this.snackbarMessage = data.message.email || data.message.password;
                            this.$refs.formLogin.validate();
                        }
                    })
                    .catch(err => {
                        // handle error
                        console.log(err);
                        this.loading = false
                    })
            },
        }
        Vue.component('paginate', VuejsPaginate)
    </script>

    <?= $this->renderSection('js') ?>

    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            computed: computedVue,
            data: dataVue,
            mounted: mountedVue,
            created: createdVue,
            watch: watchVue,
            methods: methodsVue
        })
    </script>
</body>

</html>