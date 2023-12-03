import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import "bootstrap/dist/css/bootstrap.min.css";
import NavBar from "@/Components/Navbar";

const Reservations = ({ reservations, search }) => {
    const [searchTerm, setSearchTerm] = useState(search);

    const handleSearchChange = (e) => {
        setSearchTerm(e.target.value);
    };

    const handleSearchSubmit = (e) => {
        e.preventDefault();
        Inertia.post(route("search-reservations"), { search: searchTerm });
    };

    return (
        <div className="min-h-screen bg-gray-100">
            <NavBar />
            <main>
                <br />
                <div className="mx-auto" style={{ width: "250px" }}>
                    <form
                        name="search-reservation-form"
                        id="search-reservation-form"
                        onSubmit={handleSearchSubmit}
                    >
                        <input
                            type="text"
                            className="form-control"
                            id="search"
                            name="search"
                            placeholder="Search by seats..."
                            value={searchTerm}
                            onChange={handleSearchChange}
                        />
                    </form>
                </div>
                <br />
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jmeno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Poznamka</th>
                            <th scope="col">Pocet na stani</th>
                            <th scope="col">Cena celkem</th>
                            <th scope="col">Datum platby</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {reservations.map((reservation, index) => (
                            <React.Fragment key={index}>
                                <tr>
                                    <th scope="row">{reservation.id}</th>
                                    <td>{reservation.name}</td>
                                    <td>{reservation.email}</td>
                                    <td>{reservation.note}</td>
                                    <td>{reservation.stand}</td>
                                    <td>{reservation.price_all}</td>
                                    <td>{reservation.date_payment}</td>
                                    <td>
                                        <button className="btn btn-orange">
                                            <a
                                                href={route(
                                                    "cancelReservation",
                                                    reservation.id
                                                )}
                                            >
                                                Cancel
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td scope="row">Sedadla</td>
                                    <td>
                                        {Object.values(reservation.seats).map(
                                            (seat) => (
                                                <span key={seat}>{seat}</span>
                                            )
                                        )}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </React.Fragment>
                        ))}
                    </tbody>
                </table>
            </main>
        </div>
    );
};

export default Reservations;
