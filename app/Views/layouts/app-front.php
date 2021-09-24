<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">-->
    <style>
        html {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    <div id="app">
        <v-app>

            <v-app-bar app color="purple darken-4" dark elevation="3">
                <v-app-bar-nav-icon color="yellow" @click.stop="sidebarMenu = !sidebarMenu"></v-app-bar-nav-icon>
                <v-btn href="<?= base_url() ?>" text="true">
                    <v-toolbar-title style="cursor: pointer">Amikom</v-toolbar-title>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn @click="toggleTheme" color="primary" class="mr-3">{{buttonText}}</v-btn>
                <v-btn lg color="success" class="mr-3" href="<?= base_url('/login') ?>">
                    <v-icon>mdi-login-variant</v-icon> Login
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
                <v-btn icon>
                    <v-icon>mdi-cog-outline</v-icon>
                </v-btn>
            </v-app-bar>

            <v-main>
                <?= $this->renderSection('content') ?>
            </v-main>

            <p class="mx-auto">
                {{ new Date().getFullYear() }} — <strong>amikom</strong>
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

    <script src="https://vuejs.org/js/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://unpkg.com/vuetify-image-input"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>-->

    <script>
        var computedVue = {
            mini() {
                return (this.$vuetify.breakpoint.smAndDown) || !this.toggleMini
            },
            buttonText() {
                return !this.$vuetify.theme.dark ? 'Dark' : 'Light'
            }
        }
        var createdVue = function() {
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        }
        var mountedVue = function() {}
        var watchVue = {}
        var dataVue = {
            sidebarMenu: true,
            toggleMini: false,
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
        }
        var methodsVue = {
            toggleTheme() {
                this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
            }
        }
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