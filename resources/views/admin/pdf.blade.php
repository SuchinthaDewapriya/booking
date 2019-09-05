@php
    Fpdf::AddPage();
        Fpdf::SetFont('Arial','B',16);
        foreach($booking as $bookings)
        {
            Fpdf::Cell($bookings->b_id);
            Fpdf::Ln();
        }
        
        Fpdf::Cell(40,10,'Hello World!');
        Fpdf::Output();
        exit;
@endphp