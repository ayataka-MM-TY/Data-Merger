import { parseDate, validate, ValidateArguments } from "../../utils/basic.ts"


await validate(() => {
    const args = new ValidateArguments()

    const nameParts = args.name
        .split(" ")
        .flatMap(parts => parts.split("."))
    return nameParts.some((part: string) => parseDate(part) !== null);
})
