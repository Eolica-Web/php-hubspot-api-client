<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Marketing\V2026_09;

use Eolica\Hubspot\Api\Marketing\V2026_09\TransactionalEmails\SendResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class TransactionalEmails extends Resource
{
    /**
     * @param list<string>|null $replyTo
     * @param list<string>|null $cc
     * @param list<string>|null $bcc
     * @param array<string, string>|null $contactProperties
     * @param array<string, mixed>|null $customProperties
     */
    public function send(
        int $emailId,
        string $to,
        ?string $from = null,
        ?string $sendId = null,
        ?array $replyTo = null,
        ?array $cc = null,
        ?array $bcc = null,
        ?array $contactProperties = null,
        ?array $customProperties = null,
    ): SendResponse {
        $message = array_filter([
            'to' => $to,
            'from' => $from,
            'sendId' => $sendId,
            'replyTo' => $replyTo,
            'cc' => $cc,
            'bcc' => $bcc,
        ], fn ($value) => $value !== null);

        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', statusId: string, sendResult?: 'ADDRESS_LIST_BOMBED'|'ADDRESS_ONLY_ACCEPTED_ON_PROD'|'ADDRESS_OPTED_OUT'|'ATTACHMENT_DOWNLOAD_QUEUE_FULL'|'BLOCKED_ADDRESS'|'BLOCKED_DOMAIN'|'BRAND_RECIPIENT_FATIGUE_SUPPRESSED'|'CAMPAIGN_CANCELLED'|'CANCELLED_ABUSE'|'CONTACT_VIEW_PERMISSION'|'CORRUPT_INPUT'|'EMAIL_DISABLED'|'EMAIL_UNCONFIRMED'|'GDPR_DOI_ENABLED'|'GRAYMAIL_SUPPRESSED'|'HUBL_LIMIT_EXCEEDED'|'IDEMPOTENT_FAIL'|'IDEMPOTENT_IGNORE'|'INVALID_APP_ID_ATTRIBUTION'|'INVALID_FROM_ADDRESS'|'INVALID_TO_ADDRESS'|'LOW_CONTACT_QUALITY_SCORE'|'MARKETING_ACTIVATION_DISALLOWED'|'MISSING_CONTENT'|'MISSING_REQUIRED_PARAMETER'|'MISSING_TEMPLATE_PROPERTIES'|'MTA_IGNORE'|'NON_MARKETABLE_CONTACT'|'PORTAL_AUTHENTICATION_FAILURE'|'PORTAL_EXPIRED'|'PORTAL_MISSING_MARKETING_SCOPE'|'PORTAL_NOT_AUTHORIZED_FOR_APPLICATION'|'PORTAL_OVER_LIMIT'|'PORTAL_SUSPENDED'|'PREVIOUS_SPAM'|'PREVIOUSLY_BOUNCED'|'PREVIOUSLY_UNSUBSCRIBED_BRAND'|'PREVIOUSLY_UNSUBSCRIBED_BUSINESS_UNIT'|'PREVIOUSLY_UNSUBSCRIBED_MESSAGE'|'PREVIOUSLY_UNSUBSCRIBED_PORTAL'|'QUARANTINED_ADDRESS'|'QUEUED'|'RECIPIENT_FATIGUE_SUPPRESSED'|'SENT'|'TEMPLATE_RENDER_EXCEPTION'|'THROTTLED'|'TOO_MANY_RECIPIENTS'|'UBB_GOVERNANCE_MISSING'|'UNCONFIGURED_SENDING_DOMAIN'|'UNDELIVERABLE'|'VALIDATION_FAILED'|null, message?: string|null, startedAt?: string|null, completedAt?: string|null, eventId?: array{id: string, created: string}|null}> */
        $response = $this->transporter->post('/marketing/transactional/2026-09/single-email/send', [
            'emailId' => $emailId,
            'message' => $message,
            'contactProperties' => $contactProperties,
            'customProperties' => $customProperties,
        ]);

        return SendResponse::fromResponse($response);
    }
}
