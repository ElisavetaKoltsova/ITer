import UrlPattern from "url-pattern"
import { decodeAccessToken } from "../utils/jwt.js"
import {sendError} from "h3"
import { getUserById } from "../db/users.js"

export default defineEventHandler(async (event) => {
    const endpoints = ['/api/auth/user']

    const isHandledByThisMiddleware = endpoints.some(endpoints => {
        const pattern = new UrlPattern(endpoints)

        return pattern.match(event.node.req.url)
    })

    if(!isHandledByThisMiddleware){
        return
    }

    const token = event.node.req.headers['authorization']?.split('')[1]
    const decoded = decodeAccessToken(token)
    console.log(decoded)

    if(!decoded) {
        return sendError(event, createError({
            statusCode: 401,
            statusMessage: "Unauthorized"
        }))
    }
    try {
        const userId = decoded.userId
        const user = await getUserById(userId)

        event.context.auth = {user}
    } catch (error) {
        return
    }
})