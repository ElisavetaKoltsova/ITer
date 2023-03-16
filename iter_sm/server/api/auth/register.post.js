import {sendError} from "h3"
import { createUser } from "~~/server/db/users"
import {userTransformer} from "~~/server/transformers/user.js"

export default defineEventHandler(async (event) => {
    const body = await useBody(event)

    const {username, email, password, repeatPassword, name} = body
    if(!username|| !email|| !password|| !repeatPassword|| !name)
    {
        return sendError(event, createError({statusCode: 400, statusMessage: 'Неверные параметры'}))
    }

    if(password !== repeatPassword) {
        return sendError(event, createError({statusCode: 400, statusMessage: 'Пароли не совпадают'}))
    }

    const userData = {
        username,
        email,
        password,
        name,
        profileImage: 'https://picsum.photos/200/200'
    }

    const user = await createUser(userData)

    return{
        body: userTransformer(user) 
    }
})