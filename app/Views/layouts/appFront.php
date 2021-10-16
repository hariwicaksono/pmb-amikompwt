<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">  
    <link href="<?= base_url('assets/css/styles.css')?>" rel="stylesheet">  
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
                <v-btn href="<?= base_url() ?>" text="true">
                    <v-toolbar-title style="cursor: pointer">AMIKOM</v-toolbar-title>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn text color="yellow darken-2" x-large class="d-none d-lg-block" @click="dialogOpen">
                    <v-icon>mdi-login-variant</v-icon> &nbsp;Login
                </v-btn>

                <v-btn icon color="yellow darken-3" x-large class="d-block d-lg-none" @click="dialogOpen">
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

            <v-navigation-drawer class="gdb-purple-1 yellow--text text--darken-2" v-model="sidebarMenu" app floating  :permanent="sidebarMenu" :mini-variant.sync="mini" v-if="!isMobile">
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
                <v-list-item class="px-2" @click="">
                    <v-list-item-avatar>
                        <v-icon color="yellow darken-2" large>mdi-account-outline</v-icon>
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

            <v-snackbar v-model="snackbar" :color="snackbarType" :timeout="timeout">
                <span v-if="snackbar">{{snackbarMessage}}</span>
                <template v-slot:action="{ attrs }">
                    <v-btn text v-bind="attrs" @click="snackbar = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </template>
            </v-snackbar>   
        </v-app>
    </div>
    
    <script src="https://vuejs.org/js/vue.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vuetify-image-input" type="text/javascript"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vuejs-paginate@latest" type="text/javascript"></script>
    <script src="https://unpkg.com/animejs@2.2.0/anime.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/main.js')?>" type="text/javascript"></script>
    
    <script>
        var computedVue = {
            isMobile() {
                if (this.$vuetify.breakpoint.smAndDown) {
                    return this.sidebarMenu = false
                }
            },
            mini() {
                return (this.$vuetify.breakpoint.smAndDown) || !this.toggleMini
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
            valid: true,
            textRules: [],
            emailRules: [],
            notifMessage: '',
            notifType: '',
            snackbar: false,
            timeout: 4000,
            snackbarType: '',
            snackbarMessage: '',
            show: false,
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
        }
        var methodsVue = {
            toggleTheme() {
                this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
                localStorage.setItem("dark_theme", this.$vuetify.theme.dark.toString());
            },
            dialogOpen: function() {
                this.dialog = true;
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