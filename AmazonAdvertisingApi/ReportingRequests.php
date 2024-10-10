<?php 
namespace AmazonAdvertisingApi;

use Exception;

trait ReportingRequests
{
    public function createReport($data)
    {
        return $this->operation("reporting/reports", $data, 'POST');
    }

    public function getReportStatus(string $reportId)
    {
        return $this->operation("reporting/reports/{$reportId}", null);
    }

    public function downloadReport(string $reportId)
    {
        $req = $this->operation("reporting/reports/{$reportId}");
        if ($req["success"]) {
            $json = json_decode($req["response"], true);
            if ($json["status"] == "COMPLETED") {
                return $this->download($json["url"], true);
            }
        }
        return $req;
    }
}
