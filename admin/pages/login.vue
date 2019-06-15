<template>
    <div class="container mt-5 col-5">
        <h1>Login</h1>
        <form ref="loginForm" @submit.prevent="login" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="emailField">Email address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="emailField"
                    placeholder="Enter email"
                    v-model="formData.email"
                    required
                >
                <div class="invalid-feedback">
                    Please provide a valid email address
                </div>
            </div>
            <div class="form-group">
                <label for="passwordField">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="passwordField" 
                    placeholder="Password"
                    v-model="formData.password"
                    required
                >
                <div class="invalid-feedback">
                    Please provide your password
                </div>
            </div>
            <div class="alert alert-danger" v-if="formState === 'error'">
                Authentication failed! Please check your account data.
            </div>
            <div class="alert alert-warning" v-else-if="formState === 'submitting'">
                Sending submission &hellip;
            </div>
            <div class="alert alert-success" v-else-if="formState === 'success'">
                Successfully logged in.
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            },

            formState: 'init'
        }
    },

    methods: {
        login() {
            if (this.$refs.loginForm.checkValidity() === false) {
                
            } else {
                this.formState = 'submitting';

                this.$auth.loginWith('local', {
                    data: this.formData
                }).then(() => {
                    this.$router.push('/admin');
                }, (error) => {
                    this.formState = 'error';
                });
            }
            
            this.$refs.loginForm.classList.add('was-validated');
        }
    }
}
</script>
