import React, { FormEvent, useState } from "react";
import { router } from "@inertiajs/react";
import { Button, TextInput } from "flowbite-react";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout";
import MakersTable from "../../Components/Tables/MakersTable";

export default function Makers({ Makers, search, auth }: any) {
    console.log(Makers);
    const [searchInput, setSearchInput] = useState<string>(search);

    function submitSearch(e: FormEvent) {
        e.preventDefault();
        router.post("/admin/makers/search", { search: searchInput });
    }

    function onCancelMaker(id: number) {
        router.get(`/admin/makers/${id}`);
    }

    return (
        <AuthenticatedLayout auth={auth} header={"Salony"}>
            <div className="mx-auto flex justify-center items-center px-4">
                <form
                    className="flex max-w-md flex-row gap-4"
                    name="search-makers-form"
                    id="search-makers-form"
                    method="POST"
                    onSubmit={submitSearch}
                >
                    <TextInput
                        type="text"
                        id="search"
                        name="search"
                        placeholder="Search..."
                        value={searchInput}
                        onChange={(val) => setSearchInput(val.target.value)}
                    />
                    <Button type="submit">Search</Button>
                </form>
            </div>

            <br />
            <MakersTable makers={Makers} onCancelMaker={onCancelMaker} />
            <br />
        </AuthenticatedLayout>
    );
}
