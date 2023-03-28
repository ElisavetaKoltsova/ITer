<template>
    <div>
        <div class="pt-5 space-y-6">
            <!--Username-->
            <UIInput value="" label="Username" placeholder="@username" v-model="data.username"/>
            <!--Password-->
            <UIInput value="" label="Password" 
            placeholder="********" type="password" v-model="data.password"/>

            <!--Button for Login-->
            <div>
                <button @click="handleLogin">Войти</button>
                <!--<v-btn text to="/login">Login</v-btn>
                <v-btn text to="/register">Register</v-btn>-->
            </div>
            <div>
                <button @click="changeButtonName">Ещё не зарегистрированы?</button>
            </div>

        </div>
    </div>
</template>

<script setup>
    
    
    

    const data = reactive({
        username: '',
        password: '',
        loading: false
    })

    async function handleLogin() {
        const {login} = useAuth()
        data.loading = true
        try {
            await login({
                username: data.username,
                password: data.password
            })
        } catch (error) {
            console.log(error)
        } finally {
            data.loading = false
        }
    }


</script>