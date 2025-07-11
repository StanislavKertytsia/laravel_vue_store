import { reactive } from 'vue'

type FieldRules = {
  [key: string]: {
    required?: boolean
  }
}

export function useValidation(fields: Record<string, string>, rules: FieldRules) {
  const validationErrors = reactive<Record<string, string>>({})

  function validate(): boolean {
    let isValid = true

    for (const fieldName in rules) {
      const value = fields[fieldName]
      const rule = rules[fieldName]
      validationErrors[fieldName] = ''

      if (rule.required && !value) {
        validationErrors[fieldName] = `Field is required.`
        isValid = false
      }
    }

    return isValid
  }

  return {
    validationErrors,
    validate,
  }
}
