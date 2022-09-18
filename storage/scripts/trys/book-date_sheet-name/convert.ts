import {
    XLSX,
    ConvertArguments,
    Record,
    convertDate, save, parseDate, dateMerge
} from "../../utils/basic.ts"

await (async () => {
    const args = new ConvertArguments()

    const fileDate = args.name
        .split(" ")
        .flatMap(parts => parts.split("."))
        .map(part => parseDate(part))
        .find(date => date !== null)!

    const workbook = await XLSX.readFile(args.from);
    const sheetNameList: string[] = workbook.SheetNames
    console.log(sheetNameList);

    let records: Record[] = [];

    for (const sheetName of sheetNameList) {
        const sheet = workbook.Sheets[sheetName];
        const json = XLSX.utils.sheet_to_json(sheet);
        const sheetRecords = json.map((values: { [key: string]: string | number }, index) => {
            const record = new Record();
            record.priorityNumber = index;
            record.append("氏名", sheetName);
            let isPriorityDated = false;
            for (const key in values) {
                if (typeof values[key] === "number" && !Number.isInteger(values[key])) {
                    const date = dateMerge(fileDate, convertDate(values[key] as number))
                    if (!isPriorityDated) {
                        isPriorityDated = true;
                        record.priorityDate = date;
                    }
                    record.append(key, date);
                    continue;
                }
                record.append(key, values[key]);
            }
            return record;
        })
        records = records.concat(sheetRecords);
    }


    await save(records, args.to)
})()
