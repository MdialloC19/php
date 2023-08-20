<?php
namespace Class\Enums;

echo "OfficeStatus.php is being loaded.";

enum OfficeStatus
{
    case APPROVAL_PENDING;
    case APPROVAL_APPROVED;
    case APPROVAL_REJECTED;
}