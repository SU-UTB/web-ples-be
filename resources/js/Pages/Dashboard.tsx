import {Head} from '@inertiajs/react';
import React from "react";
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout";
import {Card} from "../Components/Card";

export default function Dashboard({
                                      freeSeats,
                                      takenSeats,
                                      freeWithRautSeats,
                                      freeNormalSeats,
                                      availableStands,
                                      totalStands,
                                      moneyRaised,
                                      auth
                                  }: any) {
    return (
        <AuthenticatedLayout
            auth={auth}
            header={'Dashboard'}
        >
            <Head title="Dashboard"/>

            <div className="mx-auto px-4 grid grid-cols-4 gap-4">
                <Card title1={'Volná místa celkem:'}
                      data1={freeSeats.toString()}
                      title2={'Zabraná místa celkem:'}
                      data2={takenSeats.toString()}/>

                <Card title1={'Volná s rautem:'}
                      data1={freeWithRautSeats.toString()}
                      title2={'Volná bez rautu:'}
                      data2={freeNormalSeats.toString()}/>

                <Card title1={'Volná na stání:'}
                      data1={availableStands.toString()}
                      title2={'Prodáno na stání:'}
                      data2={(totalStands - availableStands).toString()}/>

                <Card title1={'Zisk:'}
                      data1={moneyRaised.toString() + ' Kč'}
                      title2={null}
                      data2={null}/>
            </div>
        </AuthenticatedLayout>
    );
}
