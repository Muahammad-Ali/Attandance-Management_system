@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Attendance Records</h4>
                </div>

                <div class="card-body p-4">
                    <!-- Attendance Stats -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-white mb-0">Present</h6>
                                            <h2 class="mb-0">{{ $stats['present'] }}</h2>
                                            <p class="mb-0"><small>{{ $stats['present_percentage'] }}% of classes</small></p>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-danger text-white h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-white mb-0">Absent</h6>
                                            <h2 class="mb-0">{{ $stats['absent'] }}</h2>
                                            <p class="mb-0"><small>{{ $stats['absent_percentage'] }}% of classes</small></p>
                                        </div>
                                        <i class="fas fa-times-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-white mb-0">Late</h6>
                                            <h2 class="mb-0">{{ $stats['late'] }}</h2>
                                            <p class="mb-0"><small>{{ $stats['late_percentage'] }}% of classes</small></p>
                                        </div>
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-white mb-0">Total Classes</h6>
                                            <h2 class="mb-0">{{ $stats['total'] }}</h2>
                                            <p class="mb-0"><small>This month</small></p>
                                        </div>
                                        <i class="fas fa-calendar-alt fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <form method="GET" action="{{ route('teacher.attendance') }}" class="bg-light rounded p-3 mb-4">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label for="month" class="form-label">Month</label>
                                <input type="month" id="month" name="month" class="form-control" value="{{ request('month', date('Y-m')) }}">
                            </div>
                            <div class="col-md-5 mb-2">
                                <label for="subject_id" class="form-label">Subject</label>
                                <select id="subject_id" name="subject_id" class="form-control">
                                    <option value="">All Subjects</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->subject_name }} ({{ $subject->subject_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end mb-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    <!-- Attendance Records Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td>
                                            {{ $attendance->date->format('M d, Y') }} 
                                            <span class="text-muted">({{ $attendance->day }})</span>
                                        </td>
                                        <td>
                                            {{ $attendance->subject->subject_name }}
                                            <div class="small text-muted">{{ $attendance->subject->subject_code }}</div>
                                        </td>
                                        <td>{{ $attendance->semester->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($attendance->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($attendance->end_time)->format('h:i A') }}</td>
                                        <td>
                                            @if($attendance->status == 'present')
                                                <span class="badge bg-success">Present</span>
                                            @elseif($attendance->status == 'absent')
                                                <span class="badge bg-danger">Absent</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Late</span>
                                            @endif
                                        </td>
                                        <td>{{ $attendance->remarks ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3">No attendance records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 