import React from "react";
import { Button, Table } from "flowbite-react";

const MakersTable = ({ makers, onCancelMaker }) => {
    return (
        <Table>
            <Table.Head>
                <Table.HeadCell>#</Table.HeadCell>
                <Table.HeadCell>Maker</Table.HeadCell>
                <Table.HeadCell>Time</Table.HeadCell>
                <Table.HeadCell>Service</Table.HeadCell>
                <Table.HeadCell>Name</Table.HeadCell>
                <Table.HeadCell>Phone</Table.HeadCell>
                <Table.HeadCell>Email</Table.HeadCell>
                <Table.HeadCell>Actions</Table.HeadCell>
            </Table.Head>
            <Table.Body className="divide-y">
                {makers.map((maker, index) => (
                    <Table.Row
                        key={index}
                        className="bg-white dark:border-gray-700 dark:bg-gray-800"
                    >
                        <Table.Cell className="whitespace-nowrap font-medium text-gray-900 dark:text-white">
                            {maker.id}
                        </Table.Cell>
                        <Table.Cell>{maker.maker}</Table.Cell>
                        <Table.Cell>{maker.time}</Table.Cell>
                        <Table.Cell>{maker.service}</Table.Cell>
                        <Table.Cell>{maker.name}</Table.Cell>
                        <Table.Cell>{maker.phone}</Table.Cell>
                        <Table.Cell>{maker.email}</Table.Cell>
                        <Table.Cell>
                            <Button
                                size="xs"
                                color="failure"
                                onClick={() => onCancelMaker(maker.id)}
                            >
                                Cancel
                            </Button>
                        </Table.Cell>
                    </Table.Row>
                ))}
            </Table.Body>
        </Table>
    );
};

export default MakersTable;
