export type endpointType = 'login' | 'signup'

export interface ILoginPayload {
  login: string
  password: string
}

export interface ISignupPayload {
  name: string
  lastName: string
  email: string
  phone: string
  password: string
}
