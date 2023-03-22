<template>
    <div>
        <div class="pt-5 space-y-6">
            <!--Username-->
            <UIInput value="" label="Username" placeholder="@username"/>
            <!--Password-->
            <UIInput value="" label="Password" 
            placeholder="********" type="password" />
            <UIInput value="" label="RepeatPassword" 
            placeholder="********" type="repeatPassword"/>

            <UIInput value="" label="Email" placeholder="Email"/>
            <UIInput value="" label="Name" placeholder="Name" />
            <!--Button for Login-->
            <div>
                <button @click="handleRegister">Зарегистрироваться</button>
            </div>

            <!--<UIInput value="" label="Username" placeholder="@username" v-model="data.username"/>
            
            <UIInput value="" label="Password" 
            placeholder="********" type="password" v-model="data.password"/>
            <UIInput value="" label="RepeatPassword" 
            placeholder="********" type="repeatPassword" v-model="data.repeatPassword"/>

            <UIInput value="" label="Email" placeholder="Email" v-model="data.email"/>
            <UIInput value="" label="Name" placeholder="Name" v-model="data.name"/>
            
            <div>
                <button @click="handleRegister">Зарегистрироваться</button>
            </div>-->

        </div>
    </div>
</template>

<script setup>

</script>