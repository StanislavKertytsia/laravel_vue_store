import type { endpointType, loginPayload, signupPayload } from './auth'

export async function authRequest(endpoint: endpointType, payload: loginPayload | signupPayload) {
  const response = await fetch(`http://localhost:9000/api/${endpoint}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify(payload),
  })

  const data = await response.json()
  if (!response.ok) return
  
  localStorage.setItem('token', data.token)
  return data
}
