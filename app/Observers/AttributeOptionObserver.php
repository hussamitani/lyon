<?php

namespace App\Observers;

use App\Models\AttributeOption;

class AttributeOptionObserver
{
    /**
     * Handle the AttributeOption "created" event.
     */
    public function created(AttributeOption $attributeOption): void
    {
        //
    }

    /**
     * Handle the AttributeOption "updated" event.
     */
    public function updated(AttributeOption $attributeOption): void
    {
        //
    }

    /**
     * Handle the AttributeOption "deleted" event.
     */
    public function deleted(AttributeOption $attributeOption): void
    {
        //
    }

    /**
     * Handle the AttributeOption "restored" event.
     */
    public function restored(AttributeOption $attributeOption): void
    {
        //
    }

    /**
     * Handle the AttributeOption "force deleted" event.
     */
    public function forceDeleted(AttributeOption $attributeOption): void
    {
        //
    }
}
