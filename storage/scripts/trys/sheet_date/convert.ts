import {
    XLSX,
    ConvertArguments,
    Record,
    convertDate, save, parseDate
} from "../../utils/basic.ts"

await (async () => {
    const args = new ConvertArguments()

    const workbook = await XLSX.readFile(args.from);
    const sheetNameList = workbook.SheetNames

    const records: Record[] = [];

    for (const sheetName of sheetNameList) {
        const sheet = workbook.Sheets[sheetName];
        const json = XLSX.utils.sheet_to_json(sheet)
        const titles: string[] = Object.values(json[0]);
        const sheetDate = parseDate(sheetName)!;

        let isPriorityDateSearched = false;
        const types = (Object.values(json[1]) as (string | number)[])
            .map((value: string | number) => {
                if (typeof value === "string") return "normal"
                if (Number.isInteger(value)) return "normal"
                if (isPriorityDateSearched) return "date"
                isPriorityDateSearched = true
                return "priority_date"
            })

        for (let i = 1; i < json.length; i++) {
            const values: (string | number)[] = Object.values(json[i]);
            const record = new Record();
            record.priorityNumber = i;
            for (let j = 0; j < values.length; j++) {
                if (types[j] === "date" || types[j] === "priority_date") {
                    const date = convertDate(values[j] as number)
                    date.setFullYear(sheetDate.getFullYear())
                    date.setMonth(sheetDate.getMonth())
                    date.setDate(sheetDate.getDate());
                    if (types[j] === "priority_date") {
                        record.priorityDate = date;
                    }
                    record.append(titles[j], convertDate(values[j] as number))
                    continue;
                }
                record.append(titles[j], values[j]);
            }
            records.push(record);
        }

    }


    await save(records, args.to)
})()
