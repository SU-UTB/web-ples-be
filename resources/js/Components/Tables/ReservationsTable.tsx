import { Button, Table } from "flowbite-react";

import React from "react";

const ReservationsTable = ({ reservations, onCancelReservation }: any) => {
    //TODO types
    return (
        <Table>
            <Table.Head>
                <Table.HeadCell>#</Table.HeadCell>
                <Table.HeadCell>Name</Table.HeadCell>
                <Table.HeadCell>Email</Table.HeadCell>
                <Table.HeadCell>Note</Table.HeadCell>
                <Table.HeadCell>Count of Stands</Table.HeadCell>
                <Table.HeadCell>Total Price</Table.HeadCell>
                <Table.HeadCell>Date of Payment</Table.HeadCell>
                <Table.HeadCell>
                    <span className="sr-only">Actions</span>
                </Table.HeadCell>
            </Table.Head>
            <Table.Body className="divide-y">
                {reservations.map((reservation: any, index: number) => (
                    <>
                        <Table.Row
                            key={index.toString()}
                            className="bg-white dark:border-gray-700 dark:bg-gray-800"
                        >
                            <Table.Cell className="whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                {reservation.id}
                            </Table.Cell>
                            <Table.Cell>{reservation.name}</Table.Cell>
                            <Table.Cell>{reservation.email}</Table.Cell>
                            <Table.Cell>{reservation.note}</Table.Cell>
                            <Table.Cell>{reservation.stand}</Table.Cell>
                            <Table.Cell>{reservation.price_all}</Table.Cell>
                            <Table.Cell>{reservation.date_payment}</Table.Cell>
                            <Table.Cell>
                                <Button
                                    size={"xs"}
                                    color="failure"
                                    onClick={() =>
                                        onCancelReservation(reservation.id)
                                    }
                                >
                                    <p>Cancel</p>
                                </Button>
                            </Table.Cell>
                        </Table.Row>

                        <Table.Row key={"seats" + index.toString()}>
                            <Table.Cell></Table.Cell>
                            <Table.Cell scope="row">Sedadla</Table.Cell>
                            <Table.Cell>
                                {reservation.seats.map((seat) => (
                                    <span key={seat.alias}>{seat.alias}</span>
                                ))}
                            </Table.Cell>
                            <Table.Cell></Table.Cell>
                            <Table.Cell></Table.Cell>
                            <Table.Cell></Table.Cell>
                            <Table.Cell></Table.Cell>
                            <Table.Cell></Table.Cell>
                        </Table.Row>
                    </>
                ))}
            </Table.Body>
        </Table>
    );
};

export default ReservationsTable;
