import { getUserByUsername } from "~~/server/db/users.js"
import bcrypt from bcrypt;
import { generateTokens, sendRefreshToken } from "~~/server/utils/jwt.js"
import { userTransformer } from "~~/server/transformers/user.js"
import { createRefreshToken } from "~~/server/db/refreshTokens.js"
import { sendError } from "h3"

export default defineEventHandler(async (event) => {
    const body = await useBody(event)

    const {username, password} = body

    if(!username || !password){
        return sendError(event, createError({
            statusCode: 400,
            statusMessage: 'Неверные параметры'
        }))
    }

    //Is the user user registered
    const user = await getUserByUsername(username)
    if(!user){
        return sendError(event, createError({
            statusCode: 400,
            statusMessage: 'Пароль или имя пользователя неверны'
        }))
    }

    //Compsre password
    const doesThePasswordMatch = await bcrypt.compare(password, user.password)

    if(!doesThePasswordMatch){
        return sendError(event, createError({
            statusCode: 400,
            statusMessage: 'Пароль или имя пользователя неверны'
        }))
    }

    //Generate Tokens
    //Access token
    //Refresh token
    const {accessToken, refreshToken} = generateTokens(user)

    //Save it inside db
    await createRefreshToken({
        token: refreshToken,
        userId: user.id
    })

    //Add http only cookie
    sendRefreshToken(event, refreshToken)



    return {
        access_token: accessToken,
        user: userTransformer(user)
    }


})