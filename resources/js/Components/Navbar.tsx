import React, { useState, useEffect } from "react";
import { Link } from "@inertiajs/react";
const Navbar = () => {
    const [activeLink, setActiveLink] = useState("");

    useEffect(() => {
        // Update the active link based on the current URL
        const path = window.location.pathname;
        if (path.includes("dashboard")) {
            setActiveLink("dashboard");
        } else if (path.includes("reservations")) {
            setActiveLink("reservations");
        } else if (path.includes("makers")) {
            setActiveLink("makers");
        } else {
            setActiveLink("");
        }
    }, []);

    return (
        <nav className="navbar navbar-expand-lg navbar-light">
            <div className=" navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item active">
                        <a
                            className={`nav-link ${
                                activeLink === "dashboard" ? "active" : ""
                            }`}
                            href="/admin"
                        >
                            Dashboard
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            className={`nav-link ${
                                activeLink === "reservations" ? "active" : ""
                            }`}
                            href="/admin/reservations"
                        >
                            Reservations
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            className={`nav-link ${
                                activeLink === "makers" ? "active" : ""
                            }`}
                            href="/admin/makers"
                        >
                            Makers
                        </a>
                    </li>
                </ul>
                <div className="mx-auto"></div>
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <form
                            method="POST"
                            action="/logout"
                            name="logout-form"
                            id="logout-form"
                        >
                            <div className="form-group">
                                <Link
                                    href={route("logout")}
                                    method="post"
                                    as="button"
                                    className="btn btn-blue"
                                >
                                    Logout
                                </Link>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    );
};

export default Navbar;
