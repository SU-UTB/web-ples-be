import React, { FormEvent, useState } from "react";
import { router } from "@inertiajs/react";
import { Button, Navbar, Pagination, TextInput } from "flowbite-react";
import ReservationsTable from "../../Components/Tables/ReservationsTable";

export default function Reservations({ paginationReservations, search }: any) {
    const [searchInput, setSearchInput] = useState<string>(search);

    function submitSearch(e: FormEvent) {
        e.preventDefault();
        router.post("/admin/reservations/search", { search: searchInput });
    }

    function onCancelReservation(id: number) {
        router.get(`/admin/reservations/${id}`);
    }

    return (
        //TODO solution will be after you fix whole layout
        <div
            className="min-h-screen bg-gray-100"
            key={paginationReservations.data.length.toString()}
        >
            <Navbar />

            <main>
                <br />
                <div className="mx-auto flex justify-center items-center px-4">
                    <form
                        className="flex max-w-md flex-row gap-4"
                        name="search-reservation-form"
                        id="search-reservation-form"
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
                <ReservationsTable
                    reservations={paginationReservations.data}
                    onCancelReservation={onCancelReservation}
                />
                <br />
                <div className="mx-auto flex justify-center items-center px-4">
                    <Pagination
                        currentPage={paginationReservations.current_page}
                        onPageChange={(page) => {
                            router.visit(
                                paginationReservations.path + "?page=" + page
                            );
                        }}
                        totalPages={paginationReservations.last_page}
                    />
                </div>
            </main>
        </div>
    );
}
