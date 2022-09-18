export * as XLSX from 'https://cdn.sheetjs.com/xlsx-0.18.11/package/xlsx.mjs';

const JST_TO_UTF = 540 * 60 * 1000

export const validate = async (cb: () => boolean | Promise<boolean>) => {
    console.log(await cb())
}

export class ConvertArguments {
    public readonly from: string;
    public readonly to: string;
    public readonly name: string;
    public readonly date: Date | null;
    public constructor(args: string[] = Deno.args) {
        this.from = args[0];
        this.to = args[1];
        this.name = args[2];
        this.date = args[3] === "null" ? null : new Date(Date.parse(args[3]) + JST_TO_UTF);
    }
}

export class ValidateArguments {
    public readonly from: string;
    public readonly name: string;
    public readonly date: Date | null;
    public constructor(args: string[] = Deno.args) {
        this.from = args[0];
        this.name = args[1];
        this.date = args[2] === "null" ? null : new Date(Date.parse(args[3]) + JST_TO_UTF);
    }
}

export const parseDate = (date: string): Date | null => {
    const parsed = Date.parse(date);
    if (isNaN(parsed)) return null;
    return new Date(Date.parse(date) + JST_TO_UTF);
}

const dateToString = (date: Date): string => {
    return date.toISOString()
        .split(".")[0]
        .split("T")
        .join(" ")
}

type JSONType = 'priority_date'
    | 'priority_number'
    | 'string'
    | 'int'
    | 'double'
    | 'date'
    | 'bool'

type JSONValue = { id: string, key: string, type: JSONType, value: string }

export class Value {
    public constructor(
        public readonly key: string,
        public readonly value: string | number | boolean | Date
    ) {}

    public readonly json = (id: string): JSONValue => {
        return {
            id,
            key: this.key,
            value: this.valueToString(),
            type: this.type(),
        };
    }

    private readonly type = (): JSONType => {
        switch (typeof this.value) {
            case "string":
                return 'string';
            case "boolean":
                return "bool";
            case "number":
                return Number.isInteger(this.value) ? "int" : "double";
            default:
                return "date";
        }
    }

    private readonly valueToString = (): string => {
        if (['string', 'number', 'boolean'].includes(typeof this.value)) {
            return this.value.toString();
        }
        return dateToString(this.value as Date);
    }

}

export class Record {

    public readonly uuid: string
    public priorityDate: Date | null = null
    public priorityNumber: number | null = null

    public constructor(
        public readonly values: Value[] = [],
    ) {
        this.uuid = crypto.randomUUID();
    }

    public readonly append = (key: string, value: string | number | boolean | Date) => {
        this.values.push(new Value(key, value));
    }

    public readonly json = (): JSONValue[] => {
        const values: JSONValue[] = [];
        values.push({ id: this.uuid, key: '', type: 'priority_date', value: dateToString(this.priorityDate!) });
        values.push({ id: this.uuid, key: '', type: 'priority_number', value: this.priorityNumber!.toString() });

        return values.concat(this.values.map(value => value.json(this.uuid)));
    };

    public readonly isValid = (): boolean => {
        return this.priorityDate !== null
            && this.priorityNumber !== null;
    }
}

export const save = async (records: Record[], filename: string) => {
    const json = records.filter(record => record.isValid())
        .flatMap(record => record.json())
    await Deno.writeTextFile(filename, JSON.stringify(json))
}

export const convertDate = (serial: number): Date => {
    const utc_days = Math.floor(serial - 25569)
    const utc_value = utc_days * 86400;
    const date_info = new Date(utc_value * 1000);

    const fractional_day = serial - Math.floor(serial) + 0.0000001;

    let total_seconds = Math.floor(86400 * fractional_day);

    const seconds = total_seconds % 60;

    total_seconds -= seconds;

    const hours = Math.floor(total_seconds / (60 * 60));
    const minutes = Math.floor(total_seconds / 60) % 60;

    return new Date(date_info.getFullYear(), date_info.getMonth(), date_info.getDate(), hours, minutes, seconds);
}
