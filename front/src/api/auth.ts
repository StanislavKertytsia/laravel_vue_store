export type endpointType = 'login' | 'signup'

export interface loginPayload {
  login: string
  password: string
}

export interface signupPayload {
  name: string
  lastName: string
  email: string
  phone: string
  password: string
}
