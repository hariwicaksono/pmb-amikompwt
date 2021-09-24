<?php $this->extend("layouts/app-front"); ?>
<?php $this->section("content"); ?>

<v-parallax light class="purple mt-n5">
    <v-row align="center" justify="center">
        <v-col class="text-center" cols="12">
            <h1 class="font-weight-normal mb-4">
                Amikom
            </h1>
            <h2 class="subheading">
                Build your application today!
                </h4>
        </v-col>
    </v-row>
</v-parallax>

<?php $this->endSection("content") ?>

<?php $this->section("js") ?> 
<script>
    computedVue = {
        ...computedVue,
    }
    dataVue = {
        ...dataVue,
        show1: false,
        email: '',
        emailRules: [
            (v) => !!v || 'E-mail is required',
            (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        password: '',
        rules: {
            required: value => !!value || 'Required.',
            min: v => v.length >= 8 || 'Min 8 characters',
        },
    }
    methodsVue = {
        ...methodsVue,
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