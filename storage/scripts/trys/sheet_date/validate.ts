import { XLSX, parseDate, validate, ValidateArguments } from "../../utils/basic.ts"

await validate(async () => {
    const args = new ValidateArguments()
    if (parseDate(args.name) !== null) {
        return false
    }
    const workbook = await XLSX.readFile("trys/sheet_date/タクシー会社A.xlsx");
    // const workbook = await XLSX.readFile("trys/sheet_date/タクシー会社B 2022年9月1日.xlsx");

    const sheetNameList = workbook.SheetNames
    return !sheetNameList.some((name: string) => parseDate(name) === null);
})
