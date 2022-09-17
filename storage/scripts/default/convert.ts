
const [from, to, originalName, date] = Deno.args

const records = [
    { id: crypto.randomUUID(), greet: 'Hello' },
    { id: crypto.randomUUID(), greet: 'こんにちは' },
    { id: crypto.randomUUID(), greet: 'あにょはせよ' },
    { id: crypto.randomUUID(), greet: 'ボンジュール' },
    { id: crypto.randomUUID(), greet: 'おっはー' },
]

const json = records.flatMap((record, index) => {
    return [
        [ '', 'priority_number', index + 1],
        [ '', 'priority_date', '2022-02-02' ],
        [ '挨拶', 'string', record.greet ],
    ].map((row) => {
        return {
            recordID: record.id,
            key: row[0],
            type: row[1],
            value: row[2]
        }
    })
})
await Deno.writeTextFile('log', to)
await Deno.writeTextFile(to, JSON.stringify(json))
